<?php

namespace App\Repositories\Users;

use App\User;

class UsersRepository implements UsersRepositoryInterface
{
    protected $user;
    protected $userData;

    /**
     * Construct UsersRepository
     *
     * @param User $model model
     *
     * @return void
     */
    public function __construct(User $model)
    {
        $this->user = $model;
    }

    /**
     * Set user data
     *
     * @param array $data data
     */
    public function setUserData(array $data): UsersRepository
    {
        $this->userData = $data;
        return $this;
    }

    /**
     * Store user
     *
     * @return User
     */
    public function store(): User
    {
        return $this->user->create($this->userData);
    }
}
