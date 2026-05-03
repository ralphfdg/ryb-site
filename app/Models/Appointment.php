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
    // Protect the ID from mass assignment
    protected $guarded = ['id'];

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
    public function customer(): BelongsTo
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
}