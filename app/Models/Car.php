<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Car extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $guarded = ['id'];

    // Cast the JSON features column to an array automatically
    protected function casts(): array
    {
        return [
            'features' => 'array',
        ];
    }

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
}