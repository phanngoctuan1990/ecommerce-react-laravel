<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


class BaseApiController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
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
