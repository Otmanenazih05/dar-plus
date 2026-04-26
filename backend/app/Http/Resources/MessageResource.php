<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'body'       => $this->body,
            'read_at'    => $this->read_at?->toIso8601String(),
            'created_at' => $this->created_at->toIso8601String(),
            'sender'     => [
                'id'         => $this->sender->id,
                'name'       => $this->sender->name,
                'avatar_url' => $this->sender->avatar_url
                    ? asset('storage/' . $this->sender->avatar_url)
                    : null,
            ],
        ];
    }
}
