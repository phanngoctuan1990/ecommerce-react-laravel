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
     * Set user
     *
     * @param User $user user
     */
    public function setUser($user): UsersRepository
    {
        $this->user = $user;
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
     * Get user profile
     *
     * @return User
     */
    public function profile(): User
    {
        return $this->user->load('address');
    }

    /**
     * Get user cart
     *
     * @param User
     */
    public function getUserCart(): User
    {
        return $this->user->load([
            'shoppingCartItems',
            'shoppingCartItems.product',
            'shoppingCartItems.product.image'
        ]);
    }

    /**
     * Get user orders
     *
     * @param Collection
     */
    public function getUserOrders()
    {
        return $this->user->orders->load([
            'orderItems',
            'orderItems.product',
            'orderItems.product.image'
        ]);
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
