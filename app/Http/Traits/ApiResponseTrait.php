<?php

namespace App\Http\Traits;

use Symfony\Component\HttpFoundation\Response;

trait ApiResponseTrait
{

    public function apiResponse($data = null, $message = null, $status = Response::HTTP_OK)
    {
        $response = [
            'data' => $data,
            'message'  => $message,
            'status' => $status,

        ];
        return response($response);
    }
}
