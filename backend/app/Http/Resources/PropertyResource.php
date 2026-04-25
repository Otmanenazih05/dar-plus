<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'title'            => $this->title,
            'description'      => $this->description,
            'price'            => $this->price,
            'city'             => $this->city,
            'address'          => $this->address,
            'latitude'         => $this->latitude,
            'longitude'        => $this->longitude,
            'status'           => $this->status,
            'completion_score' => $this->completion_score,
            'views_count'      => $this->views_count,
            'is_featured'      => $this->is_featured,
            'created_at'       => $this->created_at?->toDateString(),
            'category'         => $this->whenLoaded('category', fn() => [
                'id'   => $this->category->id,
                'name' => $this->category->name,
                'slug' => $this->category->slug,
                'icon' => $this->category->icon,
            ]),
            'seller'           => $this->whenLoaded('user', fn() => [
                'id'         => $this->user->id,
                'name'       => $this->user->name,
                'avatar_url' => $this->user->avatar_url,
                'city'       => $this->user->city,
                'phone'      => $this->user->phone,
            ]),
            'cover_image'      => $this->whenLoaded('coverMedia', fn() => $this->coverMedia
                ? asset('storage/' . $this->coverMedia->file_path)
                : null
            ),
            'media'            => $this->whenLoaded('media', fn() =>
                PropertyMediaResource::collection($this->media)
            ),
            'field_values'     => $this->whenLoaded('fieldValues', fn() =>
                $this->fieldValues->mapWithKeys(fn($fv) => [
                    $fv->blueprintField->field_key => $fv->value,
                ])
            ),
        ];
    }
}
