<?php

namespace App\Traits;

/**
 * 
 */
trait ResponseTrait
{
    public function success($message, $code = null, $data = null)
    {
        return response()->json([
            'message' => $message,
            'code' => $code,
            'data' => $data
        ], $code);
    }

    public function failure($message, $code = null, $data = null)
    {
        return response()->json([
            'message' => $message,
            'code' => $code,
            'data' => $data
        ], $code);
    }
}
