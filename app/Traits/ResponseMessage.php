<?php

namespace App\Traits;

/**
 * Json response validation message
 */
trait ResponseMessage
{
    protected function successMessage($message = 'Success', $data = null, $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data
        ], $code);
    }

    /**
     * Show response message
     * 
     * @param mixed|array|string $message
     * @param integer $code
     * @return json
     */
    protected function failsMessage($message, $code = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data'    => null
        ], $code);
    }
}
