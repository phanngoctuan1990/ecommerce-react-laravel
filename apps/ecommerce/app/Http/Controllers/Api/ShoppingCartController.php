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
}
