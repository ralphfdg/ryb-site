<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'model',
        'year',
        'price',
        'description',
        'status', // e.g., 'Available', 'Sold'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function specification()
    {
        return $this->hasOne(CarSpecification::class);
    }

    public function images()
    {
        return $this->hasMany(CarImage::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function sale()
    {
        return $this->hasOne(Sale::class);
    }
}