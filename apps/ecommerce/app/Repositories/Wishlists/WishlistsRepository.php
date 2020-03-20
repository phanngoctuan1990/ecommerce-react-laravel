<?php

namespace App\Repositories\Wishlists;

use App\User;

class WishlistsRepository implements WishlistsRepositoryInterface
{
    protected $user;

    /**
     * Set user data
     *
     * @param User $user user
     *
     * @return WishlistsRepository
     */
    public function setUser(User $user): WishlistsRepository
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get wishlists by user
     *
     * @return array
     */
    public function getWishlistsByUser(): array
    {
        return $this->user->wishlistItems->pluck('product')->all();
    }
}
