<?php

namespace App\Http\Resources\UserAddress;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
        ];
    }
}
