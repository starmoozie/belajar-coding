<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\User;

class UserAddressRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id'     => [
                'required',
                Rule::exists(User::class, 'id')
            ],
            'is_domicile' => 'required|boolean',
            'address'     => 'required',
        ];
    }
}
