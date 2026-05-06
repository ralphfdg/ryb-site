<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();

            // Maps to users.id (char(36) UUID)
            $table->foreignUuid('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Maps to cars.id (bigint)
            $table->foreignId('car_id')
                  ->constrained('cars')
                  ->cascadeOnDelete();

            // Composite Unique Constraint: 
            // Prevents a user from saving the exact same car multiple times.
            $table->unique(['user_id', 'car_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};