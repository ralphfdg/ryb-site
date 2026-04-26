<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create the isolated roles
        $adminRole = Role::create(['name' => 'Admin']);
        $customerRole = Role::create(['name' => 'Customer']);

        // Create a default Super Admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@rybtrading.com'],
            [
                'name' => 'System Administrator',
                'password' => Hash::make('password'), // Change this in production
                'phone_number' => '0000000000',
            ]
        );

        // Assign the Admin role
        $admin->assignRole($adminRole);
    }
}
