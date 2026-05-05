<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
     * Get the specification associated with the car.
     */
    public function specification(): HasOne
    {
        return $this->hasOne(CarSpecification::class);
    }
}