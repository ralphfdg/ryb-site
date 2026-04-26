<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarSpecification extends Model
{
    protected $fillable = [
        'car_id',
        'vin_number',
    ];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}