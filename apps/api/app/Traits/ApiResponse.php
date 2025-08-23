<?php

namespace App\Traits;

trait ApiResponse
{
    protected function successResponse($data = null, $error = '', $code = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'error' => $error,
        ], $code);
    }

    protected function errorResponse($data = null, $error = 'Failed', $code = 400)
    {
        return response()->json([
            'success' => false,
            'data' => $data,
            'error' => $error,
        ], $code);
    }
}
