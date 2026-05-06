<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class Car extends Model implements HasMedia
{
    use InteractsWithMedia, SoftDeletes;

    protected $guarded = ['id'];

    // Cast the JSON features column to an array automatically
    protected $casts = [
        'features' => AsArrayObject::class, // This tells Laravel to auto-decode the JSON
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
    ];

    /**
     * Relationship: A Car belongs to a Brand.
     */
    public function brand(): BelongsTo
    {
        // Eloquent automatically assumes the foreign key is 'brand_id'
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get the specification associated with the car.
     */
    public function carSpecification(): HasOne
    {
        return $this->hasOne(CarSpecification::class);
    }

    public function carType()
    {
        return $this->belongsTo(CarType::class);
    }

    // Optional: Define specific media conversions (e.g., thumbnails for the catalog)
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width(300)
              ->height(300)
              ->sharpen(10);
    }
}
