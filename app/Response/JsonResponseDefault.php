<?php

declare(strict_types=1);

namespace App\Response;

use Illuminate\Http\JsonResponse as Response;

class JsonResponseDefault
{
    public static function create($success, $data, $message = 'Success', $code = 200)
    {
        $response = [
            'success' => $success,
            'data' => $data,
            'message' => $message,
            'code' => $code,
        ];

        $header = [$response['code'] => $response['message']];

        return new Response($response, $response['code'], $header);
    }
}
