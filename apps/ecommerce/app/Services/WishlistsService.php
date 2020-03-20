<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Wishlists\WishlistsRepositoryInterface;

class WishlistsService extends BaseService
{
    protected $request;
    protected $wishlistRepo;

    /**
     * Create a new controller instance.
     *
     * @param WishlistsRepositoryInterface $wishlistRepo wishlist repository
     *
     * @return void
     */
    public function __construct(WishlistsRepositoryInterface $wishlistRepo)
    {
        $this->wishlistRepo = $wishlistRepo;
    }

    /**
     * Get user wishlist
     *
     * @param AddWishlistRequest $request request
     *
     * @return WishlistsService
     */
    public function setRequest($request): WishlistsService
    {
        $this->request = $request;
        return $this;
    }

    /**
     * Get user wishlist
     *
     * @return array
     */
    public function getUserWishlist(): array
    {
        return $this->wishlistRepo
            ->setUser(Auth::user())
            ->getWishlistsByUser();
    }

    /**
     * Add wishlist
     *
     * @return void
     */
    public function addWishlist()
    {
        dd($this->request->all());
    }
}
