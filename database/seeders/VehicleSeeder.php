<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Brand;
use App\Models\CarType;
use App\Models\CarSpecification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        // Retrieve lookup tables
        $brands = Brand::all();
        $types = CarType::pluck('id', 'name');

        // Mapping Models to specific Car Types for data integrity
        $inventoryData = [
            'Toyota' => [
                ['model' => 'Camry TRD', 'type' => 'Sedan'],
                ['model' => 'Supra MK5', 'type' => 'Coupe'],
                ['model' => 'Land Cruiser', 'type' => 'SUV'],
                ['model' => 'Hilux Conquest', 'type' => 'Pickup'],
                ['model' => 'Innova Zenix', 'type' => 'Van/MPV'],
            ],
            'Tesla' => [
                ['model' => 'Model S Plaid', 'type' => 'Sedan'],
                ['model' => 'Model X', 'type' => 'SUV'],
                ['model' => 'Model 3 Performance', 'type' => 'Sedan'],
                ['model' => 'Cyberbeast', 'type' => 'Pickup'],
            ],
            'BMW' => [
                ['model' => 'M4 Competition', 'type' => 'Coupe'],
                ['model' => 'X5 M-Sport', 'type' => 'SUV'],
                ['model' => 'i7 M70', 'type' => 'Sedan'],
                ['model' => 'Z4 Roadster', 'type' => 'Convertible'],
                ['model' => 'M5 Touring', 'type' => 'Wagon'],
            ],
            'Ford' => [
                ['model' => 'Mustang Dark Horse', 'type' => 'Coupe'],
                ['model' => 'F-150 Raptor', 'type' => 'Pickup'],
                ['model' => 'Explorer', 'type' => 'SUV'],
                ['model' => 'Ranger Raptor', 'type' => 'Pickup'],
            ],
        ];

        foreach ($brands as $brand) {
            if (!isset($inventoryData[$brand->brand_name])) continue;

            foreach ($inventoryData[$brand->brand_name] as $item) {
                // 1. Create the Car
                $car = Car::create([
                    'brand_id' => $brand->id,
                    'car_type_id' => $types[$item['type']] ?? null, // Link to CarType table
                    'model_name' => $item['model'],
                    'year' => rand(2021, 2026),
                    'price' => rand(1500000, 8000000), // Adjusted for Philippine Peso[cite: 1]
                    'mileage' => rand(0, 25000),
                    'transmission' => collect(['Automatic', 'Manual', 'CVT'])->random(),
                    'fuel_type' => collect(['Gasoline', 'Diesel', 'Electric', 'Hybrid'])->random(),
                    'previous_owners' => rand(0, 2),
                    'plate_ending' => rand(0, 9),
                    'features' => [
                        'Adaptive Cruise Control',
                        '360 Degree Camera',
                        'Wireless Charging',
                        'Apple CarPlay / Android Auto',
                        'Blind Spot Monitoring',
                        'Panoramic Moonroof'
                    ],
                    'status' => 'Available', // Globally scoped status[cite: 1]
                    'is_featured' => rand(0, 10) > 7 ? 1 : 0, 
                ]);

                // 2. Create the Specification (1:1 Relationship)[cite: 1]
                CarSpecification::create([
                    'car_id' => $car->id,
                    'vin_number' => strtoupper(Str::random(17)),
                    'engine_type' => collect(['2.0L Turbo', '3.0L V6', 'Dual Electric Motor', '5.0L V8'])->random(),
                    'color_exterior' => collect(['Soul Red Crystal', 'Sonic Titanium', 'Arctic White', 'Jet Black'])->random(),
                    'color_interior' => collect(['Black Nappa Leather', 'Beige Alcantara', 'Saddle Brown Leather'])->random(),
                    'fuel_capacity' => rand(50, 90) . ' Liters',
                ]);
            }
        }
    }
}