<?php

namespace App\Traits;

/**
 * Json response validation message
 */
trait ResponseMessage
{
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
