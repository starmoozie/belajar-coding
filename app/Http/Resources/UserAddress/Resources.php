<?php

namespace App\Http\Resources\UserAddress;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\Resources as UserResources;

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
            'id'            => $this->id,
            'is_domicile'   => $this->is_domicile,
            'address'       => $this->address,
            'user'          => $this->user($this->user),
        ];
    }

    /**
     * Transform the resource belongsTo relationship into an array.
     *
     * @return array<string, mixed>
     */
    private function user($user)
    {
        return [
            'id'      => $user->id,
            'name'    => $user->name,
            'email'   => $user->email,
        ];
    }
}
