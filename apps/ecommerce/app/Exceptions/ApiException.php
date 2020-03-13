<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    public function __construct($message = null, $code = 2000, Exception $previous = null)
    {
        parent::__construct(json_encode($message), $code, $previous);
    }

    public function render($request)
    {
        $res = [
            'success'           => false,
            'error_messages'    => json_decode($this->message),
            'error_code'        => $this->code
        ];
        return response()->json($res, 200);
    }
}
