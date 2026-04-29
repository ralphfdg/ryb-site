<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            'Toyota', 'Honda', 'Ford', 'Chevrolet', 
            'Nissan', 'BMW', 'Mercedes-Benz', 'Audi'
        ];

        foreach ($brands as $brandName) {
            Brand::firstOrCreate([
                'brand_name' => $brandName
            ]);
        }
    }
}
