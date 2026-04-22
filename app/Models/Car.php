<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Car extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'brand_id',
        'model',
        'year',
        'price',
        'description',
        'status', // e.g., 'Available', 'Sold'
    ];

    // Spatie Medialibrary configuration
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('car_images')
             ->useFallbackUrl('/images/placeholder-car.png')
             ->useFallbackPath(public_path('/images/placeholder-car.png'));
    }

    // Relationships
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function specification()
    {
        return $this->hasOne(CarSpecification::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function sale()
    {
        return $this->hasOne(Sale::class);
    }
}