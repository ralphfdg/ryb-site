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
        Schema::create('car_specifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id')->unique();;
            $table->string('vin_number', 17)->unique();;
            $table->string('engine_type', 50);
            $table->string('color_exterior', 30);
            $table->string('color_interior', 30);
            $table->string('fuel_capacity', 15);
            $table->timestamps();

            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_specifications');
    }
};
