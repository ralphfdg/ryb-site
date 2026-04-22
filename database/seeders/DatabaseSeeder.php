<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test Admin User',
            'email' => 'admin@ryb.com',
            'role' => 'Admin', // Fulfills the migration requirement
            'phone_number' => '+639123456789', // Fulfills the migration requirement
            'password' => Hash::make('password123'), // Good practice to explicitly set for test accounts
        ]);
    }
}