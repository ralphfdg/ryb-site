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
    Schema::create('inquiries', function (Blueprint $table) {
        $table->id();
        $table->foreignUuid('user_id')->nullable()->constrained('users')->nullOnDelete(); // Nullable for Guests
        $table->foreignId('car_id')->nullable()->constrained('cars')->nullOnDelete(); // Nullable for general inquiries
        $table->string('subject');
        $table->text('message');
        $table->string('status')->default('Unread'); // Unread, Read, Resolved
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
