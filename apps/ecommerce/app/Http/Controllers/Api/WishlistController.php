<?php

namespace App\Http\Controllers\Api;

use App\Services\WishlistsService;
use App\Http\Requests\AddWishlistRequest;
use App\Http\Requests\WishlistToCartRequest;

class WishlistController extends BaseApiController
{
    protected $wishlistService;

    /**
     * Create a new controller instance.
     *
     * @param WishlistsService $wishlistService wishlist service
     *
     * @return void
     */
    public function __construct(WishlistsService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
    }

    /**
     * Get user wishlist
     *
     * @return json
     */
    public function getUserWishlist()
    {
        $products = $this->wishlistService->getUserWishlist();
        return $this->sendResponse($products);
    }

    /**
     * Add wishlist
     *
     * @param AddWishlistRequest $request request
     *
     * @return json
     */
    public function addWishlist(AddWishlistRequest $request)
    {
        $this->wishlistService->setRequest($request)->addWishlist();
        return $this->sendResponse(['message' => 'Added to wishlist']);
    }

    /**
     * Remove wishlist
     *
     * @param int $productId product id
     *
     * @return json
     */
    public function removeWishlist(int $productId)
    {
        $this->wishlistService->setProductId($productId)->removeWishlistByProductId();
        return $this->sendResponse(['message' => 'Removed from wishlist']);
    }

    /**
     * Wishlist to cart
     *
     * @param WishlistToCartRequest $request request
     *
     * @return json
     */
    public function wishlistToCart(WishlistToCartRequest $request)
    {
        $this->wishlistService->setProductId($request->product_id)->wishlistToCart();
        return $this->sendResponse(['message' => 'Added wishlist item to cart']);
    }
}
