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
     * Store user
     */
    public function store();
}
