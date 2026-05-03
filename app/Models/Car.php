<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes; // Preserves financial integrity per our data dictionary

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