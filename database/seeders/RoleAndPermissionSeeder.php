<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions to prevent XAMPP caching anomalies
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Define our core roles based on the data dictionary
        Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'Customer', 'guard_name' => 'web']);
    }
}   
