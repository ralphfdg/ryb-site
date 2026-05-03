<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarSpecification extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the car that owns the specification.
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}