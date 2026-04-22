<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // 1. Import the trait

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids; // 2. Add the trait here

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', 
        'phone_number', // 3. Added phone_number so it can be seeded/saved
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function purchases()
    {
        return $this->hasMany(Sale::class, 'customer_id');
    }

    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }
}