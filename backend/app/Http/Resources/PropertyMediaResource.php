<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyMediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'slot_key'  => $this->whenLoaded('slot', fn() => $this->slot->slot_key),
            'file_path' => $this->file_path,
            'file_url'  => asset('storage/' . $this->file_path),
            'file_type' => $this->file_type,
            'is_cover'  => $this->is_cover,
        ];
    }
}
