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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
        $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete();
        $table->string('model_name');
        $table->string('transmission');
        $table->string('fuel_type');
        $table->integer('year');
        $table->integer('mileage');
        $table->integer('previous_owners')->default(0);
        $table->integer('plate_ending');
        $table->decimal('price', 12, 2);
        $table->json('features'); // Cast to AsArrayObject::class in model
        $table->enum('status', ['Available', 'Reserved', 'Sold'])->default('Available');
        $table->boolean('is_featured')->default(false);
        $table->timestamps();
        $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
