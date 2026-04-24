<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlueprintFieldResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'field_key'   => $this->field_key,
            'field_label' => $this->field_label,
            'field_type'  => $this->field_type,
            'options'     => $this->options,
            'is_required' => $this->is_required,
            'sort_order'  => $this->sort_order,
        ];
    }
}
