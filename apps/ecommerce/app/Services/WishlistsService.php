<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Wishlists\WishlistsRepositoryInterface;

class WishlistsService extends BaseService
{
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
     * @return array
     */
    public function getUserWishlist(): array
    {
        return $this->wishlistRepo
            ->setUser(Auth::user())
            ->getWishlistsByUser();
    }
}
