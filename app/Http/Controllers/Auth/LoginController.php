<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Http\Resources\User\Resources;

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
        $entry = User::firstWhere('email', $request->email);
        $entry->token = $entry->createToken('MyToken')->accessToken;
        return $this->successMessage(new Resources($entry));
    }
}
