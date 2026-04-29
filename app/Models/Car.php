<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Car extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'brand_id', 'model_name', 'year', 'price', 
        'mileage', 'transmission', 'fuel_type', 
        'description', 'features', 'status'
    ];

    // Laravel 12 casting method
    protected function casts(): array
    {
        return [
            'features' => 'array',
            'price' => 'decimal:2',
            'year' => 'integer',
        ];
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function specification(): HasOne
    {
        return $this->hasOne(CarSpecification::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}