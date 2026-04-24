<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'email'      => $this->email,
            'role'       => $this->role,
            'phone'      => $this->phone,
            'city'       => $this->city,
            'avatar_url' => $this->avatar_url,
            'bio'        => $this->bio,
            'is_active'  => $this->is_active,
            'created_at' => $this->created_at?->toDateString(),
        ];
    }
}
