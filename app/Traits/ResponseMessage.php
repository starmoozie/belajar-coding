<?php

namespace App\Traits;

/**
 * Json response validation message
 */
trait ResponseMessage
{
    protected function successMessage($data = null, $message = null, $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message ?: __("message.success_".request()->method(), ['attribute' => request()->segment(2)]),
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
    protected function failsMessage($message = null, $code = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message ?: __("message.fails_".request()->method(), ['attribute' => request()->segment(2)]),
            'data'    => null
        ], $code);
    }
}
