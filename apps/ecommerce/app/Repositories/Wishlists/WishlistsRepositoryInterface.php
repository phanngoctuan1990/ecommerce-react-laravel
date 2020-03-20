<?php

namespace App\Repositories\Wishlists;

use App\User;

interface WishlistsRepositoryInterface
{
    /**
     * Set user data
     *
     * @param User $user user
     */
    public function setUser(User $user);

    /**
     * Get wishlists by user
     */
    public function getWishlistsByUser();
}
