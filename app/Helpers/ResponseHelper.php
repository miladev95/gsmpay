<?php

namespace App\Helpers;

class ResponseHelper
{
    public static function success($data, $statusCode = 200)
    {
        return response()->json([
            'data' => $data,
            'server_time' => now()->toIso8601String(),
        ], $statusCode);
    }

    public static function error($message, $statusCode = 400)
    {
        return response()->json([
            'data' => ['error' => $message],
            'server_time' => now()->toIso8601String(),
        ], $statusCode);
    }
}
