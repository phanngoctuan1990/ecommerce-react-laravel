<?php

namespace App\Repositories\Users;

use App\User;

class UsersRepository implements UsersRepositoryInterface
{
    protected $user;

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
     * Store user
     *
     * @param array $data data
     *
     * @return User
     */
    public function store(array $data) :User
    {
        return $this->user->create($data);
    }
}
