<?php

namespace App\Http\Controllers\Api;

use App\Services\ShoppingCartsService;
use App\Http\Requests\AddToCartRequest;

class ShoppingCartController extends BaseApiController
{
    protected $shoppingCartService;

    /**
     * Create a new controller instance.
     *
     * @param ShoppingCartsService $shoppingCartService shopping cart service
     *
     * @return void
     */
    public function __construct(ShoppingCartsService $shoppingCartService)
    {
        $this->shoppingCartService = $shoppingCartService;
    }

    /**
     * Add to cart.
     *
     * @param AddToCartRequest $request request
     *
     * @return json
     */
    public function addToCart(AddToCartRequest $request)
    {
        $this->shoppingCartService->setRequest($request)->addToCart();
        return $this->sendResponse(['message' => 'Added to cart']);
    }

    /**
     * Add to cart.
     *
     * @param int $productId product id
     *
     * @return json
     */
    public function removeFromCart(int $productId)
    {
        $this->shoppingCartService->setProductId($productId)->removeFromCart();
        return $this->sendResponse(['message' => 'Removed to cart']);
    }

    /**
     * get user cart.
     *
     * @return json
     */
    public function getUserCart()
    {
        return $this->sendResponse(
            $this->shoppingCartService->getUserCart()
        );
    }
}
