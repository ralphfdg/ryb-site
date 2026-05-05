<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarSpecification extends Model
{
    use HasFactory;

    // Explicitly define the table name if Laravel is struggling to pluralize it
    protected $table = 'car_specifications';

    // Mass Assignable attributes to allow the Seeder to insert data
    protected $fillable = [
        'car_id',
        'vin_number',
        'engine_type',
        'color_exterior',
        'color_interior',
        'fuel_capacity',
    ];

    /**
     * Inverse Relationship: A Specification belongs to a Car.
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}