<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'subject',
        'message',
        'status',
    ];

    /**
     * The user who made the inquiry (Nullable for guest traffic).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The specific car inquired about (Nullable for general questions).
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}