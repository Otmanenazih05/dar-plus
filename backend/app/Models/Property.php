<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'price',
        'city',
        'address',
        'latitude',
        'longitude',
        'status',
        'completion_score',
        'views_count',
        'is_featured',
    ];

    protected $casts = [
        'price'            => 'integer',
        'latitude'         => 'float',
        'longitude'        => 'float',
        'completion_score' => 'integer',
        'views_count'      => 'integer',
        'is_featured'      => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function fieldValues(): HasMany
    {
        return $this->hasMany(PropertyFieldValue::class);
    }

    public function media(): HasMany
    {
        return $this->hasMany(PropertyMedia::class);
    }

    public function coverMedia()
    {
        return $this->hasOne(PropertyMedia::class)->where('is_cover', true);
    }
}
