<?php

namespace App\Repositories\Users;

use App\User;

class UsersRepository implements UsersRepositoryInterface
{
    protected $user;
    protected $email;
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
     * Set email
     *
     * @param string $email email
     */
    public function setEmail(string $email): UsersRepository
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get user by email
     *
     * @return User
     */
    public function getUserByEmail()
    {
        return $this->user->whereEmail($this->email)->first();
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
