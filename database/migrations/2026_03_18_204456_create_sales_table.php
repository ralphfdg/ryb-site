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
    Schema::create('sales', function (Blueprint $table) {
        // Using 'uuid' as the column name per your Data Dictionary, but making it the PK
        $table->uuid('uuid')->primary(); 
        $table->foreignId('car_id')->constrained('cars');
        $table->foreignUuid('customer_id')->constrained('users');
        $table->foreignId('appointment_id')->constrained('appointments');
        $table->decimal('sale_price', 12, 2);
        $table->enum('payment_method', ['Cash', 'Financing']);
        $table->timestamps();
        $table->softDeletes();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
