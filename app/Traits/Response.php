<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait Response
{
    public function response($code, $message, $data = null): JsonResponse
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function responseException($code, $message): JsonResponse
    {
        return response()->json([
            'code' => $code,
            'message' => $message
        ], $code);
    }
}
