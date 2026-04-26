<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\Car;
use Illuminate\Support\Str;

class DummyInventorySeeder extends Seeder
{
    public function run(): void
    {
        // 1. Define our premium brands
        $brands = [
            'Toyota' => ['Camry TRD', 'Supra', 'Land Cruiser'],
            'Tesla' => ['Model 3', 'Model S Plaid', 'Model X'],
            'BMW' => ['M4 Competition', 'M5', 'X6 M'],
            'Mercedes' => ['AMG GT', 'G63 AMG', 'C63 S'],
            'Porsche' => ['911 GT3', 'Taycan Turbo S', 'Cayenne'],
            'Audi' => ['RS6 Avant', 'R8 V10', 'RS e-tron GT'],
        ];

        // 2. Loop through and create data
        foreach ($brands as $brandName => $models) {
            // Create the Brand
            $brand = Brand::firstOrCreate(['brand_name' => $brandName]);

            // Create 3-4 cars for each brand
            foreach ($models as $modelName) {
                // Determine a random status (mostly Available, some Sold)
                $status = rand(1, 100) > 70 ? 'Sold' : 'Available';
                
                // Base price range based on the brand
                $price = match($brandName) {
                    'Porsche', 'Mercedes', 'BMW' => rand(80000, 200000),
                    'Tesla', 'Audi' => rand(60000, 150000),
                    default => rand(30000, 80000),
                };

                // Create the Car
                $car = Car::create([
                    'brand_id' => $brand->id,
                    'price' => $price,
                    'status' => $status,
                    'features' => [
                        'model' => $modelName,
                        'year' => rand(2022, 2024),
                        'mileage' => rand(500, 35000),
                        'transmission' => 'Automatic',
                        'fuel_type' => $brandName === 'Tesla' ? 'Electric' : 'Gasoline',
                    ],
                ]);

                // Create the 1:1 VIN Specification
                $car->specification()->create([
                    'vin_number' => strtoupper(Str::random(17)),
                ]);
            }
        }
    }
}