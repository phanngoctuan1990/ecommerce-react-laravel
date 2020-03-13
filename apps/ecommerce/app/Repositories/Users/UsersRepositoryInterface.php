<?php

namespace App\Repositories\Users;

interface UsersRepositoryInterface
{
    /**
     * Store user
     *
     * @param array $data data
     */
    public function store(array $data);
}
