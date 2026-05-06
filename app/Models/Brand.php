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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('brand_logos')
            ->singleFile();
    }
}
