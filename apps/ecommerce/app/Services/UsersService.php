<?php

namespace App\Services;

use DB;
use Log;
use Hash;
use App\User;
use Exception;
use App\Repositories\Users\UsersRepositoryInterface;
use App\Repositories\Address\AddressRepositoryInterface;

class UsersService extends BaseService
{
    protected $request;
    protected $userRepository;
    protected $addressRepository;

    /**
     * Create a new controller instance.
     *
     * @param UsersRepositoryInterface   $userRepository    user repository
     * @param AddressRepositoryInterface $addressRepository address repository
     *
     * @return void
     */
    public function __construct(
        UsersRepositoryInterface $userRepository,
        AddressRepositoryInterface $addressRepository
    ) {
        $this->userRepository = $userRepository;
        $this->addressRepository = $addressRepository;
    }

    /**
     * Set request
     *
     * @param Request $request request
     *
     * @return UsersService
     */
    public function setRequest($request): UsersService
    {
        $this->request = $request;
        return $this;
    }

    /**
     * Register user
     *
     * @return User|Exception
     */
    public function registerUser(): User
    {
        try {
            $user = DB::transaction(function () {
                $user = $this->userRepository->store([
                    'name' => $this->request['name'],
                    'email' => $this->request['email'],
                    'userTypeId' => User::TYPE_BUYER,
                    'password' => Hash::make($this->request['password']),
                ]);

                $this->addressRepository->store([
                    'user_id' => $user->id,
                    'zip' => $this->request['zip'],
                    'city' => $this->request['city'],
                    'state' => $this->request['state'],
                    'phone' => $this->request['phone'],
                    'first_address' => $this->request['first_address'],
                    'second_address' => $this->request['second_address'],
                ]);
                return $user;
            }, self::ATTEMPTS_COUNT);
            return $user;
        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }
    }
}
