<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function blueprintFields(): HasMany
    {
        return $this->hasMany(BlueprintField::class)->orderBy('sort_order');
    }

    public function blueprintMediaSlots(): HasMany
    {
        return $this->hasMany(BlueprintMediaSlot::class)->orderBy('sort_order');
    }
}
