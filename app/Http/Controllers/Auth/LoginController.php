<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    use \App\Traits\ResponseMessage;

    /**
     * Handle not authenticated login
     */
    public function unauthenticated()
    {
        return $this->failsMessage(__('auth.token_invalid'));
    }

    /**
     * Handle user login
     */
    public function login(LoginRequest $request)
    {
        # code...
    }
}
