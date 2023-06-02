<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Role;

class UserRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:50',
            'email' => [
                'required',
                'max:50',
                'email',
                Rule::unique(User::class)->when($this->method() === 'PUT', fn($q) => $q->ignore($this->user))
            ],
            'password' => 'required|confirmed',
            'role_id' => [
                'required',
                Rule::exists(Role::class, 'id')
            ]
        ];
    }

    /**
     * Handle hashing password after validation.
     */
    public function passedValidation(): void
    {
        $this->merge(['password' => \Hash::make($this->password)]);
    }

    /**
     * Add param to validated request.
     */
    public function validated($key = null, $default = null): array
    {
        $parent = parent::validated();

        return !$this->password
            ? $parent
            : array_merge($parent, ['password' => $this->password]);
    }
}
