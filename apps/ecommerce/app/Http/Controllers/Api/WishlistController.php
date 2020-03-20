<?php

namespace App\Http\Controllers\Api;

use App\Services\WishlistsService;

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
}
