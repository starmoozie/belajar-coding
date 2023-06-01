<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserAddress\Collections;
use App\Http\Resources\Role\Resources as RoleResources;

class Resources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->id,
            'name'    => $this->name,
            'email'   => $this->email,
            'address' => new Collections($this->address),
            'role'    => new RoleResources($this->role)
        ];
    }
}
