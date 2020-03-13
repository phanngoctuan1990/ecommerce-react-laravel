<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    /**
     * Create a new controller instance.
     *
     * @param string    $message message
     * @param int       $code    status code
     * @param Exception $previous previous
     *
     * @return void
     */
    public function __construct($message = null, $code = 2000, Exception $previous = null)
    {
        parent::__construct(json_encode($message), $code, $previous);
    }

    /**
     * Handler render
     *
     * @param Request $request request
     *
     * @return json
     */
    public function render($request)
    {
        $request = $request;

        $res = [
            'success'           => false,
            'error_code'        => $this->code,
            'error_messages'    => json_decode($this->message),
        ];
        return response()->json($res, 200);
    }
}
