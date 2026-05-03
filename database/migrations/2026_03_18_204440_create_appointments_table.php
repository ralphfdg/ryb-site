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
    Schema::create('appointments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('car_id')->constrained('cars');
        $table->foreignUuid('user_id')->constrained('users'); // Foreign UUID syntax
        $table->dateTime('scheduled_at');
        $table->enum('status', ['Pending', 'Approved', 'Viewed', 'Committed', 'Cancelled'])->default('Pending');
        $table->decimal('negotiated_price', 12, 2)->nullable();
        $table->boolean('commitment_status')->default(false);
        $table->text('admin_remarks')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
