<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlueprintMediaSlotResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'slot_key'   => $this->slot_key,
            'slot_label' => $this->slot_label,
            'media_type' => $this->media_type,
            'is_required'=> $this->is_required,
            'sort_order' => $this->sort_order,
            'hint'       => $this->hint,
            'max_count'  => $this->max_count,
        ];
    }
}
