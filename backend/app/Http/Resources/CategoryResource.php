<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'icon'        => $this->icon,
            'description' => $this->description,
            'is_active'   => $this->is_active,
            'fields'      => $this->whenLoaded('blueprintFields', function () {
                $fields = BlueprintFieldResource::collection($this->blueprintFields);
                return [
                    'required' => $fields->filter(fn($f) => $f->is_required)->values(),
                    'optional' => $fields->filter(fn($f) => !$f->is_required)->values(),
                ];
            }),
            'media_slots' => $this->whenLoaded('blueprintMediaSlots', function () {
                $slots = BlueprintMediaSlotResource::collection($this->blueprintMediaSlots);
                return [
                    'required' => $slots->filter(fn($s) => $s->is_required)->values(),
                    'optional' => $slots->filter(fn($s) => !$s->is_required)->values(),
                ];
            }),
        ];
    }
}
