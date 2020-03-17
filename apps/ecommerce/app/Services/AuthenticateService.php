<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class AuthenticateService extends BaseService
{
    protected $request;
    protected $_request;

    /**
     * Create a new controller instance.
     *
     * @param Request $request request
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->_request = $request;
    }

    /**
     * Set request
     *
     * @param Request $request request
     *
     * @return AuthenticateService
     */
    public function setRequest($request): AuthenticateService
    {
        $this->request = $request;
        return $this;
    }

    /**
     * Handle Login
     *
     * @return json|exception
     */
    public function login()
    {
        try {
            $this->_request->request->add([
                'grant_type'    => 'password',
                'client_id'     => config('auth.client_id'),
                'client_secret' => config('auth.client_secret'),
                'username'      => $this->request->email,
                'password'      => $this->request->password,
                'scope'         => '*'
            ]);

            $oauth2 = Request::create('/oauth/token', 'post');
            $response = Route::dispatch($oauth2);
            $response = json_decode($response->getContent(), true);

            if (isset($response['error'])) {
                throw new ApiException('Token invalid');
            }

            return $response;
        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }
    }

    /**
     * Refresh the access token
     *
     * @return json|exception
     */
    public function refreshToken()
    {
        try {
            $this->_request->request->add([
                'grant_type'    => 'refresh_token',
                'client_id'     => config('auth.client_id'),
                'client_secret' => config('auth.client_secret'),
            ]);

            $oauth2 = Request::create('/oauth/token', 'post');
            $response = Route::dispatch($oauth2);
            $response = json_decode($response->getContent(), true);

            if (!isset($response['access_token'])) {
                throw new ApiException('Token invalid');
            }
            return $response;
        } catch (Exception $e) {
            Log::error($e);
            throw $e;
        }
    }

    /**
     * Logout the user and revoke access token
     *
     * @return array
     */
    public function logout(): array
    {
        $this->request->user()->token()->revoke();
        return ['message' => 'Successfully logged out.'];
    }
}
