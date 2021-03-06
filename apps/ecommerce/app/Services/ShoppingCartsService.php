<?php

namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Users\UsersRepositoryInterface;
use App\Repositories\ShoppingCarts\ShoppingCartsRepositoryInterface;

class ShoppingCartsService extends BaseService
{
    protected $request;
    protected $productId;
    protected $userRepository;
    protected $shoppingCartRepo;

    /**
     * Create a new controller instance.
     *
     * @param UsersRepositoryInterface         $userRepository   user repository
     * @param ShoppingCartsRepositoryInterface $shoppingCartRepo shopping cart repository
     *
     * @return void
     */
    public function __construct(
        UsersRepositoryInterface $userRepository,
        ShoppingCartsRepositoryInterface $shoppingCartRepo
    ) {
        $this->userRepository = $userRepository;
        $this->shoppingCartRepo = $shoppingCartRepo;
    }

    /**
     * Set request
     *
     * @param Request request request
     *
     * @return ShoppingCartsService
     */
    public function setRequest($request): ShoppingCartsService
    {
        $this->request = $request;
        return $this;
    }

    /**
     * Set product id
     *
     * @param int productId product id
     *
     * @return ShoppingCartsService
     */
    public function setProductId(int $productId): ShoppingCartsService
    {
        $this->productId = $productId;
        return $this;
    }

    /**
     * Add to cart
     *
     * @return void
     */
    public function addToCart()
    {
        $shoppingCart = $this->shoppingCartRepo
            ->setShoppingCartData([
                'wish_list' => false,
                'is_expired' => false,
                'user_id' => Auth::user()->id,
                'product_id' => $this->request->product_id
            ])
            ->firstOrCreate();

        $this->shoppingCartRepo
            ->setShoppingCartId($shoppingCart->id)
            ->setShoppingCartData(['quantity' => $this->request->quantity])
            ->updateById();
    }

    /**
     * Remove from cart
     *
     * @return void
     */
    public function removeFromCart()
    {
        $this->shoppingCartRepo
            ->setConditions([
                'wish_list' => false,
                'user_id' => Auth::user()->id,
                'product_id' => $this->productId,
            ])
            ->deleteByConditions();
    }

    /**
     * Get user cart
     *
     * @return User
     */
    public function getUserCart(): User
    {
        return $this->userRepository
            ->setUser(Auth::user())
            ->getUserCart();
    }
}
