<?php

namespace App\Services;

use App\Repositories\ShoppingCarts\ShoppingCartsRepositoryInterface;

class ShoppingCartsService extends BaseService
{
    protected $request;
    protected $shoppingCartRepo;

    /**
     * Create a new controller instance.
     *
     * @param ShoppingCartsRepositoryInterface $shoppingCartRepo shopping cart repository
     *
     * @return void
     */
    public function __construct(ShoppingCartsRepositoryInterface $shoppingCartRepo)
    {
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
                'user_id' => $this->request->user()->id,
                'product_id' => $this->request->product_id
            ])
            ->firstOrCreate();

        $this->shoppingCartRepo
            ->setShoppingCartId($shoppingCart->id)
            ->setShoppingCartData(['quantity' => $this->request->quantity])
            ->updateById();
    }
}
