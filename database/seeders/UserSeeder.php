<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role; // Required for Spatie RBAC

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Bootstrap Spatie Roles
        // firstOrCreate prevents duplicate entry exceptions during re-seeding
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $customerRole = Role::firstOrCreate(['name' => 'Customer']);

        // 2. Create the Super Admin for the Novus Team
        $admin = User::firstOrCreate(
            ['email' => 'admin@rybvehicles.com'], // Search by unique index
            [
                'name' => 'RYB Administrator',
                'password' => Hash::make('password123'), // Secure Bcrypt/Argon hashing
                'phone_number' => '+639123456789',
                'email_verified_at' => now(),
                'role' => 'Admin',
            ]
        );
        
        // 3. Assign Spatie Role explicitly
        if (!$admin->hasRole('Admin')) {
            $admin->assignRole($adminRole);
        }

        // 4. Create a dummy Customer for testing Sales and Inquiries
        $customer = User::firstOrCreate(
            ['email' => 'customer@test.com'],
            [
                'name' => 'Test Customer',
                'password' => Hash::make('password123'),
                'phone_number' => '+639987654321',
                'email_verified_at' => now(),
                'role' => 'Customer',
            ]
        );

        // 5. Assign Spatie Role explicitly
        if (!$customer->hasRole('Customer')) {
            $customer->assignRole($customerRole);
        }
    }
}