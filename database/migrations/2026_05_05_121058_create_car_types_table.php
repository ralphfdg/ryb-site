<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Create the new car_types table
        Schema::create('car_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // 2. Modify the existing cars table to include the foreign key
        Schema::table('cars', function (Blueprint $table) {
            // Using constrained() automatically references the 'id' on 'car_types'
            $table->foreignId('car_type_id')->nullable()->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign(['car_type_id']);
            $table->dropColumn('car_type_id');
        });
        Schema::dropIfExists('car_types');
    }
};
