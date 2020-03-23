<?php

namespace App\Repositories\Users;

interface UsersRepositoryInterface
{
    /**
     * Set user data
     *
     * @param array $data data
     */
    public function setUserData(array $data);

    /**
     * Set user
     *
     * @param User $user user
     */
    public function setUser($user);

    /**
     * Set email
     *
     * @param string $email email
     */
    public function setEmail(string $email);

    /**
     * Get user by email
     */
    public function getUserByEmail();

    /**
     * Get user profile
     *
     * @param User
     */
    public function profile();

    /**
     * Get user cart
     *
     * @param User
     */
    public function getUserCart();

    /**
     * Get user orders
     *
     * @param User
     */
    public function getUserOrders();

    /**
     * Store user
     */
    public function store();
}
