<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PropertyMedia extends Model
{
    protected $fillable = [
        'property_id',
        'blueprint_media_slot_id',
        'file_path',
        'file_type',
        'is_cover',
    ];

    protected $casts = [
        'is_cover' => 'boolean',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function slot(): BelongsTo
    {
        return $this->belongsTo(BlueprintMediaSlot::class, 'blueprint_media_slot_id');
    }
}
