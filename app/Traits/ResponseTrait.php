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
            'status' => "OK",
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function failure($message, $code = null, $data = null)
    {
        return response()->json([
            'status' => "FAILURE",
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
