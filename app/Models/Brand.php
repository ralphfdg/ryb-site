<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Brand extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'brand_name',
    ];

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }

    // Define the specific collection for logos
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('brand_logos')
             ->singleFile() // Ensures a brand only ever has one active logo
             ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml']);
    }
}