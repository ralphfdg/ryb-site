<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create the Super Admin for the Novus Team
        $admin = User::firstOrCreate(
            ['email' => 'admin@rybvehicles.com'], // Search by email
            [
                'name' => 'RYB Administrator',
                'password' => Hash::make('password123'), // Secure hashing
                'phone_number' => '+639123456789',
                'email_verified_at' => now(),
            ]
        );
        
        // Assign Spatie Role
        if (!$admin->hasRole('Admin')) {
            $admin->assignRole('Admin');
        }

        // 2. Create a dummy Customer for testing Sales and Inquiries
        $customer = User::firstOrCreate(
            ['email' => 'customer@test.com'],
            [
                'name' => 'Test Customer',
                'password' => Hash::make('password123'),
                'phone_number' => '+639987654321',
                'email_verified_at' => now(),
            ]
        );

        if (!$customer->hasRole('Customer')) {
            $customer->assignRole('Customer');
        }
    }
}
