<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $score      = $this->completion_score;
        $badgeLabel = $score >= 80 ? 'Fully Documented' : 'Needs More Details';
        $badgeType  = $score >= 80 ? 'success' : 'warning';

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
            'completion_score' => $score,
            'badge_label'      => $badgeLabel,
            'badge_type'       => $badgeType,
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
                'avatar_url' => $this->user->avatar_url
                    ? asset('storage/' . $this->user->avatar_url)
                    : null,
                'city'       => $this->user->city,
                'phone'      => $this->user->phone,
                'member_since' => $this->user->created_at?->toDateString(),
            ]),
            'cover_image'      => $this->whenLoaded('coverMedia', fn() => $this->coverMedia
                ? asset('storage/' . $this->coverMedia->file_path)
                : null
            ),
            'media'            => $this->whenLoaded('media', function () {
                return $this->media
                    ->groupBy(fn($m) => $m->slot?->slot_key ?? 'uncategorized')
                    ->map(fn($items) => $items->map(fn($m) => [
                        'id'        => $m->id,
                        'file_url'  => asset('storage/' . $m->file_path),
                        'file_type' => $m->file_type,
                        'is_cover'  => $m->is_cover,
                        'slot_key'  => $m->slot?->slot_key,
                        'slot_label'=> $m->slot?->slot_label,
                    ])->values());
            }),
            'field_values'     => $this->whenLoaded('fieldValues', function () {
                return $this->fieldValues->map(fn($fv) => [
                    'field_key'   => $fv->blueprintField?->field_key,
                    'field_label' => $fv->blueprintField?->field_label,
                    'field_type'  => $fv->blueprintField?->field_type,
                    'is_required' => $fv->blueprintField?->is_required,
                    'value'       => $fv->value,
                ])->values();
            }),
        ];
    }
}
