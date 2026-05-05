<?php

namespace Database\Seeders;

use App\Models\CarType;
use Illuminate\Database\Seeder;

class CarTypeSeeder extends Seeder
{
    /**
     * Seed the car types for visual filtering.
     */
    public function run(): void
    {
        $types = [
            'Sedan',
            'SUV',
            'Hatchback',
            'Pickup',
            'Coupe',
            'Convertible',
            'Van/MPV',
            'Wagon'
        ];

        foreach ($types as $type) {
            CarType::updateOrCreate(['name' => $type]);
        }
    }
}