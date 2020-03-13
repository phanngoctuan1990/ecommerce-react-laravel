<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\UsersService;
use App\Http\Requests\LoginRequest;
use App\Services\AuthenticateService;
use App\Http\Requests\RegisterUserRequest;

class AuthController extends BaseApiController
{
    protected $userService;
    protected $authService;

    /**
     * Create a new controller instance.
     *
     * @param AuthenticateService $authService  auth service
     * @param UsersService        $usersService user service
     *
     * @return void
     */
    public function __construct(
        AuthenticateService $authService,
        UsersService $usersService
    ) {
        $this->authService = $authService;
        $this->usersService = $usersService;
    }

    /**
     * Authenticate the user
     *
     * @param LoginRequest $request request
     *
     * @return json|exception
     */
    public function login(LoginRequest $request)
    {

        return $this->sendResponse(
            $this->authService
                ->setRequest($request)
                ->login()
        );
    }

    /**
     * Refresh the access token
     *
     * @return json|exception
     */
    public function refreshToken()
    {
        return $this->sendResponse(
            $this->authService
                ->refreshToken()
        );
    }

    /**
     * Logout the user and revoke access token
     *
     * @param Request $request request
     *
     * @return json
     */
    public function logout(Request $request)
    {
        return $this->sendResponse(
            $this->authService
                ->setRequest($request)
                ->logout()
        );
    }

    /**
     * Register user
     *
     * @param RegisterUserRequest $request request
     *
     * @return json
     */
    public function register(RegisterUserRequest $request)
    {
        return $this->sendResponse(
            $this->usersService
                ->setRequest($request)
                ->registerUser()
        );
    }
}
