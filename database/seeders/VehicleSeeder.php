<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Brand;
use App\Models\CarSpecification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        $brands = Brand::all();

        // Sample Models per Brand
        $models = [
            'Toyota' => ['Camry TRD', 'Supra MK5', 'Land Cruiser'],
            'Tesla' => ['Model S Plaid', 'Model 3 Performance', 'Cyberbeast'],
            'BMW' => ['M4 Competition', 'X5 M-Sport', 'i7 M70'],
            'Ford' => ['Mustang Dark Horse', 'F-150 Raptor', 'Explorer'],
        ];

        foreach ($brands as $brand) {
            if (!isset($models[$brand->brand_name])) continue;

            foreach ($models[$brand->brand_name] as $modelName) {
                // 1. Create the Car
                $car = Car::create([
                    'brand_id' => $brand->id,
                    'model_name' => $modelName,
                    'year' => rand(2022, 2025),
                    'price' => rand(35000, 120000),
                    'mileage' => rand(0, 15000),
                    'transmission' => collect(['Automatic', 'Manual'])->random(),
                    'fuel_type' => collect(['Gasoline', 'Electric', 'Hybrid'])->random(),
                    'description' => "This $modelName is a premium vehicle offering top-tier performance and glassmorphism-inspired luxury interiors.",
                    'features' => [
                        'Adaptive Cruise Control',
                        'Panoramic Sunroof',
                        'Heated Seats',
                        'Apple CarPlay / Android Auto'
                    ],
                    'status' => 'Available',
                ]);

                // 2. Create the 1:1 Specification
                CarSpecification::create([
                    'car_id' => $car->id,
                    'vin_number' => strtoupper(Str::random(17)),
                    'engine_type' => 'V8 Twin Turbo',
                    'color_exterior' => collect(['Obsidian Black', 'Pearl White', 'Titanium Grey'])->random(),
                    'color_interior' => 'Midnight Black Leather',
                    'fuel_capacity' => '18 Gallons',
                ]);
            }
        }
    }
}