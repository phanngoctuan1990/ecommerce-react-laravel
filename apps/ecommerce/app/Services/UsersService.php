<?php

namespace App\Services;

use App\User;
use Exception;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Mail\VerifyMailAdapter;
use App\Repositories\Users\UsersRepositoryInterface;
use App\Repositories\Address\AddressRepositoryInterface;

class UsersService extends BaseService
{
    protected $request;
    protected $verifyMail;
    protected $userRepository;
    protected $addressRepository;

    /**
     * Create a new controller instance.
     *
     * @param VerifyMailAdapter          $verifyMail        verify email
     * @param UsersRepositoryInterface   $userRepository    user repository
     * @param AddressRepositoryInterface $addressRepository address repository
     *
     * @return void
     */
    public function __construct(
        VerifyMailAdapter $verifyMail,
        UsersRepositoryInterface $userRepository,
        AddressRepositoryInterface $addressRepository
    ) {
        $this->verifyMail = $verifyMail;
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
     * Get profile
     *
     * @return User
     */
    public function profile(): User
    {
        return $this->userRepository->setUser(Auth::user())->profile();
    }

    /**
     * Register user
     *
     * @return User|Exception
     */
    public function registerUser(): User
    {
        $verifyEmail = $this->verifyMail
            ->setEmail($this->request['email'])
            ->verify();

        if (!$verifyEmail) {
            throw new ApiException('Your email not exists, please change to another', 400);
        }

        try {
            $user = DB::transaction(function () {
                $user = $this->userRepository
                    ->setUserData([
                        'name' => $this->request['name'],
                        'email' => $this->request['email'],
                        'userTypeId' => User::TYPE_BUYER,
                        'password' => Hash::make($this->request['password']),
                    ])
                    ->store();

                $this->addressRepository
                    ->setAddressData([
                        'user_id' => $user->id,
                        'zip' => $this->request['zip'],
                        'city' => $this->request['city'],
                        'state' => $this->request['state'],
                        'phone' => $this->request['phone'],
                        'first_address' => $this->request['first_address'],
                        'second_address' => $this->request['second_address'],
                    ])
                    ->store();
                return $user;
            }, self::ATTEMPTS_COUNT);
            return $user;
        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }
    }
}
