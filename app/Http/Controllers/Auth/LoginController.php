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
        $auth = $request->user();

        $this->removeAllTokens($auth);

        $auth->token = $auth->createToken('MyToken')->accessToken;

        return $this->successMessage(new Resources($auth));
    }

    /**
     * Remove all tokens user
     */
    public function removeAllTokens($auth)
    {
        $auth->tokens->each(fn($q) => $q->delete());
    }
}
