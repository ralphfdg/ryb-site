<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    use HasUuids, SoftDeletes;

   protected $fillable = [
        'car_id', 'customer_id', 'sale_price', 'sale_date', 'payment_method'
    ];

    protected function casts(): array
    {
        return [
            'sale_date' => 'datetime',
            'sale_price' => 'decimal:2',
        ];
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class)->withTrashed(); // Retrieve even if car is soft deleted
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id')->withTrashed(); // Retrieve even if user is soft deleted
    }
}