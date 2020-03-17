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
     * Store user
     */
    public function store();
}
