<?php

namespace App\Http\Requests\Auth;

use App\Rules\Auth\CheckLoginRule;
use App\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email'     => [
                'required',
                new CheckLoginRule($this->password)
            ],
            'password'  => 'required',
        ];
    }
}
