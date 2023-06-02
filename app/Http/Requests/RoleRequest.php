<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Role;
use App\Models\Menu;

class RoleRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:20',
                Rule::unique(Role::class)->when($this->method() === 'PUT', fn($q) => $q->ignore($this->role))
            ],
            'menu' => 'required',
            'menu.*.id' => [
                'required',
                Rule::exists(Menu::class)
            ]
        ];
    }
}