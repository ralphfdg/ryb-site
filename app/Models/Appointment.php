<?php
namespace App\Models;

use App\Observers\AppointmentObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[ObservedBy([AppointmentObserver::class])]
class Appointment extends Model
{
    protected $fillable = [
        'car_id',
        'user_id',
        'scheduled_at',
        'status',
        'negotiated_price',
        'commitment_status',
        'admin_remarks',
    ];

    /**
     * Laravel 12 type casting method.
     */
    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
            'commitment_status' => 'boolean',
            'negotiated_price' => 'decimal:2',
        ];
    }

    /**
     * The vehicle requested for viewing.
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * The authenticated user requesting the viewing.
     * Note: We specify 'user_id' explicitly as the foreign key.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * An appointment can result in exactly one sale.
     */
    public function sale(): HasOne
    {
        return $this->hasOne(Sale::class);
    }

    protected static function booted()
{
    static::creating(function ($appointment) {
        // Final integrity check: ensure the car isn't already Sold
        if ($appointment->car->status === 'Sold') {
            return false; // Aborts creation
        }
    });
}
}