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
    Schema::create('audit_logs', function (Blueprint $table) {
        $table->id();
        $table->foreignUuid('user_id')->nullable()->constrained('users')->nullOnDelete(); // Admin who made the change
        $table->string('event'); // created, updated, deleted
        $table->morphs('auditable'); // Creates auditable_type and auditable_id
        $table->json('old_values')->nullable();
        $table->json('new_values')->nullable();
        $table->string('ip_address')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
