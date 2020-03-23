<?php

namespace App\Services;

use App\User;
use App\Payment;
use App\ShippingOption;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\DB;
use App\Contracts\Mail\MailAdapter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Mail\VerifyMailAdapter;
use App\Repositories\Users\UsersRepositoryInterface;
use App\Repositories\Orders\OrdersRepositoryInterface;
use App\Repositories\Payments\PaymentsRepositoryInterface;
use App\Repositories\OrderItems\OrderItemsRepositoryInterface;
use App\Repositories\PaymentMethods\PaymentMethodsRepositoryInterface;
use App\Repositories\ShoppingCarts\ShoppingCartsRepositoryInterface;
use App\Repositories\UserPromotionCodes\UserPromotionCodesRepositoryInterface;

class OrdersService extends BaseService
{
    protected $mail;
    protected $request;
    protected $verifyMail;
    protected $paymentRepo;
    protected $userRepository;
    protected $orderRepository;
    protected $shoppingCartRepo;
    protected $paymentMethodRepo;
    protected $userPromoCodeRepo;
    protected $orderItemRepository;

    /**
     * Create a new controller instance.
     *
     * @param MailAdapter                           $mail                mail
     * @param VerifyMailAdapter                     $verifyMail          verify email
     * @param UsersRepositoryInterface              $userRepository      user repository
     * @param OrdersRepositoryInterface             $orderRepository     order repository
     * @param PaymentsRepositoryInterface           $paymentRepo         payment repository
     * @param OrderItemsRepositoryInterface         $orderItemRepository order repository
     * @param ShoppingCartsRepositoryInterface      $shoppingCartRepo    shopping cart repository
     * @param PaymentMethodsRepositoryInterface     $paymentMethodRepo   payment method repository
     * @param UserPromotionCodesRepositoryInterface $userPromoCodeRepo   user promotion codes repository
     *
     * @return void
     */
    public function __construct(
        MailAdapter $mail,
        VerifyMailAdapter $verifyMail,
        PaymentsRepositoryInterface $paymentRepo,
        UsersRepositoryInterface $userRepository,
        OrdersRepositoryInterface $orderRepository,
        ShoppingCartsRepositoryInterface $shoppingCartRepo,
        OrderItemsRepositoryInterface $orderItemRepository,
        PaymentMethodsRepositoryInterface $paymentMethodRepo,
        UserPromotionCodesRepositoryInterface $userPromoCodeRepo
    ) {
        $this->mail = $mail;
        $this->verifyMail = $verifyMail;
        $this->paymentRepo = $paymentRepo;
        $this->userRepository = $userRepository;
        $this->orderRepository = $orderRepository;
        $this->shoppingCartRepo = $shoppingCartRepo;
        $this->paymentMethodRepo = $paymentMethodRepo;
        $this->userPromoCodeRepo = $userPromoCodeRepo;
        $this->orderItemRepository = $orderItemRepository;
    }

    /**
     * Set request
     *
     * @param Request request request
     *
     * @return OrdersService
     */
    public function setRequest($request): OrdersService
    {
        $this->request = $request;
        return $this;
    }

    /**
     * Get user order
     *
     * @return User
     */
    public function getUserOrders()
    {
        return $this->userRepository->setUser(Auth::user())->getUserOrders();
    }

    /**
     * Place order
     *
     * @return void|Exception
     */
    public function placeOrder()
    {
        $verifyEmail = $this->verifyMail
            ->setEmail($this->request->email)
            ->verify();

        if (!$verifyEmail) {
            throw new ApiException('Your email not exists, please change to another', 400);
        }

        $paymentMethod = $this->paymentMethodRepo
            ->setName($this->request->payment_method)
            ->getPaymentMethodByName();

        if (!$paymentMethod) {
            throw new ApiException('Payment method not found', 404);
        }

        $current = now();
        $user = $this->userRepository
            ->setEmail($this->request->email)
            ->getUserByEmail();

        $userId = $user ? $user->id : null;

        try {
            DB::transaction(function () use ($paymentMethod, $user, $current, $userId) {
                $payment = $this->paymentRepo
                    ->setPaymentData([
                        'amount' => $this->request->amount_due,
                        'status' => Payment::SUCCESS_TYPE,
                        'time_stamp' => $current,
                        'payment_method_id' => $paymentMethod->id,
                    ])
                    ->store();
                $order = $this->orderRepository
                    ->setOrderData([
                        'order_date' => $current,
                        'total_amount' => $this->request->total_amount,
                        'payment_id' => $payment->id,
                        'user_id' => $userId,
                        'shipping_option_id' => ShippingOption::ORDER_PLACED,
                        'promotion_code_id' => $this->request->promotion_code_id,
                    ])
                    ->store();
                if ($this->request->promotion_code_id) {
                    $this->userPromoCodeRepo
                        ->setUserPromotionCodeData([
                            'user_id' => $userId,
                            'order_id' => $order->id,
                            'promotion_code_id' => $this->request->promotion_code_id,
                        ])
                        ->store();
                }

                $productsId = [];
                collect($this->request->products)->map(function ($product) use ($order, &$productsId) {
                    $this->orderItemRepository->setOrderItemData([
                        'quantity' => $product['quantity'],
                        'product_id' => $product['product_id'],
                        'price' => $product['price'],
                        'order_id' => $order->id
                    ])->store();
                    $productsId[] = $product['product_id'];
                });

                if ($user) {
                    $this->shoppingCartRepo
                        ->setUserId($user->id)
                        ->setWishList(false)
                        ->setProductsId($productsId)
                        ->setShoppingCartData(['is_expired' => true])
                        ->updateByProductsIdWishListUserId();
                }
            }, self::ATTEMPTS_COUNT);

            $this->mail
                ->setMailTo($this->request->email)
                ->setDetail($this->request->all())
                ->sendMailOrderPlaced();
        } catch (\Exception $e) {
            Log::error($e);
            throw $e;
        }
    }
}
