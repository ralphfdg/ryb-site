<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions. 
        // This is a critical Spatie best practice to prevent cache conflict errors during seeding.
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Define Core System Permissions
        $permissions = [
            // Admin-specific permissions
            'manage inventory',      // Add, edit, delete cars and brands
            'manage appointments',   // Approve, alter times, mark as viewed/committed
            'manage sales',          // Log final sales, view financial ledger
            'view customers',        // Access the customer directory
            
            // Customer-specific permissions
            'book appointments',     // Request a car viewing
            'view own appointments', // Access personal appointment history
        ];

        // 2. Create Permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 3. Create Roles and Assign Permissions
        
        // The Customer Role
        $customerRole = Role::firstOrCreate(['name' => 'Customer']);
        $customerRole->givePermissionTo([
            'book appointments',
            'view own appointments',
        ]);

        // The Admin Role
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->givePermissionTo([
            'manage inventory',
            'manage appointments',
            'manage sales',
            'view customers',
        ]);
        
    }
}
