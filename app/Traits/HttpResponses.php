<?php

namespace App\Traits;

trait HttpResponses
{
    protected function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'Request was Successful.',
            'message' => $message,
            'date' => $data
        ], $code);
    }
    protected function error($data, $message = null, $code)
    {
        return response()->json([
            'status' => 'Error had occurred...',
            'message' => $message,
            'date' => $data
        ], $code);
    }
}
