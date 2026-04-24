<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlueprintMediaSlot extends Model
{
    protected $fillable = [
        'category_id',
        'slot_key',
        'slot_label',
        'media_type',
        'is_required',
        'sort_order',
        'hint',
        'max_count',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'sort_order'  => 'integer',
        'max_count'   => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
