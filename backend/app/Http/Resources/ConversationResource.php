<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $userId = $request->user()?->id;

        $otherUser = $this->buyer_id === $userId ? $this->seller : $this->buyer;

        $unreadCount = $this->whenLoaded('messages', fn() =>
            $this->messages
                ->where('sender_id', '!=', $userId)
                ->whereNull('read_at')
                ->count()
        );

        return [
            'id'            => $this->id,
            'last_message_at' => $this->last_message_at?->toIso8601String(),
            'unread_count'  => $unreadCount,
            'other_user'    => [
                'id'         => $otherUser->id,
                'name'       => $otherUser->name,
                'avatar_url' => $otherUser->avatar_url
                    ? asset('storage/' . $otherUser->avatar_url)
                    : null,
            ],
            'property'      => $this->whenLoaded('property', fn() => [
                'id'          => $this->property->id,
                'title'       => $this->property->title,
                'price'       => $this->property->price,
                'city'        => $this->property->city,
                'cover_image' => $this->property->coverMedia
                    ? asset('storage/' . $this->property->coverMedia->file_path)
                    : null,
            ]),
            'last_message'  => $this->whenLoaded('lastMessage', fn() =>
                $this->lastMessage ? [
                    'body'       => $this->lastMessage->body,
                    'sender_id'  => $this->lastMessage->sender_id,
                    'created_at' => $this->lastMessage->created_at->toIso8601String(),
                ] : null
            ),
            'messages'      => $this->whenLoaded('messages', fn() =>
                MessageResource::collection($this->messages)
            ),
        ];
    }
}
