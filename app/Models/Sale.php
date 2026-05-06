<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    use SoftDeletes, HasUuids;

    protected $fillable = [
        'car_id',
        'customer_id',
        'appointment_id',
        'sale_price',
        'payment_method',
    ];
    
    protected function casts(): array
    {
        return [
            'sale_price' => 'decimal:2',
        ];
    }

    /**
     * The vehicle that was sold.
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    /**
     * The customer who purchased the vehicle.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * The appointment/negotiation that led to this sale.
     */
    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }
}