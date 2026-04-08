<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo_path', // Adjust based on your exact column name
    ];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}