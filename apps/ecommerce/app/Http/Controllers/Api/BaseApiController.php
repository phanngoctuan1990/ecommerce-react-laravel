<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseApiController extends Controller
{
    /**
     * success response method.
     *
     * @param array $data       data
     * @param int   $statusCode status code
     *
     * @return json
     */
    public function sendResponse($data, $statusCode = 200)
    {
        $response = [
            'success'   => true,
            'data'      => $data,
        ];

        return response()->json($response, $statusCode);
    }
}
