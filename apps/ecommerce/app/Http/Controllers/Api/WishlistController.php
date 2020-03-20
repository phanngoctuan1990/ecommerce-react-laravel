<?php

namespace App\Http\Controllers\Api;

use App\Services\WishlistsService;
use App\Http\Requests\AddWishlistRequest;

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
}
