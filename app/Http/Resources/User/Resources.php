<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserAddress\Collections;
use App\Http\Resources\Role\Resources as RoleResources;

class Resources extends JsonResource
{
    const LOGIN_ROUTE = 'login.post';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $default = [
            'id'      => $this->id,
            'name'    => $this->name,
            'email'   => $this->email,
            'address' => new Collections($this->address),
            'role'    => new RoleResources($this->role)
        ];

        if (\Route::currentRouteName() === Self::LOGIN_ROUTE) {
            return [
                ...$default,
                'token' => $this->token
            ];
        }

        return $default;
    }
}
