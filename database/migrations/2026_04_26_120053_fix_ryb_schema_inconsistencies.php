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
        // 1. Fix the Price Limit & Standardize Status in 'cars'
        Schema::table('cars', function (Blueprint $table) {
            $table->decimal('price', 12, 2)->change(); // Fixes the 999.99 limit
            // Enforce strict statuses at the database level to prevent typos
            $table->enum('status', ['Available', 'Sold', 'Reserved'])->default('Available')->change();
        });

        // 2. Remove Redundant 'role' Column in 'users'
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });

        // 3. Fix Polymorphic 'model_id' in 'media' to support User/Sale UUIDs
        Schema::table('media', function (Blueprint $table) {
            $table->dropIndex('media_model_type_model_id_index');
            $table->uuid('model_id')->change();
            $table->index(['model_type', 'model_id'], 'media_model_type_model_id_index');
        });

        // 4. Set 'uuid' as Primary Key in 'sales' and 'audit_logs'
        Schema::table('sales', function (Blueprint $table) {
            $table->primary('uuid');
        });
        Schema::table('audit_logs', function (Blueprint $table) {
            $table->primary('uuid');
        });

        // 5. Inquiries: Allow Guest Users to send messages
        Schema::table('inquiries', function (Blueprint $table) {
            // Drop the old strict foreign key
            $table->dropForeign(['user_id']);
            
            // Make user_id nullable for guests
            $table->char('user_id', 36)->nullable()->change();
            
            // Add name and email for guests
            $table->string('name')->after('car_id')->nullable();
            $table->string('email')->after('name')->nullable();

            // Re-add foreign key, but if user is deleted, just set this to NULL instead of deleting the inquiry
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });

        // 6. Sales: Protect Financial Records from Cascade Deletions
        Schema::table('sales', function (Blueprint $table) {
            // Drop the dangerous cascading deletes
            $table->dropForeign(['car_id']);
            $table->dropForeign(['customer_id']);

            // Re-add them with RESTRICT (the Laravel default if no action is chained).
            // Now, MySQL will block anyone from hard-deleting a Car or User if a Sale record exists for them.
            $table->foreign('car_id')->references('id')->on('cars');
            $table->foreign('customer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropForeign(['car_id']);
            $table->dropForeign(['customer_id']);
            $table->foreign('car_id')->references('id')->on('cars')->cascadeOnDelete();
            $table->foreign('customer_id')->references('id')->on('users')->cascadeOnDelete();
            $table->dropPrimary(['uuid']);
        });

        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['name', 'email']);
            $table->char('user_id', 36)->nullable(false)->change();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });

        Schema::table('audit_logs', function (Blueprint $table) {
            $table->dropPrimary(['uuid']);
        });

        Schema::table('media', function (Blueprint $table) {
            $table->dropIndex('media_model_type_model_id_index');
            $table->unsignedBigInteger('model_id')->change();
            $table->index(['model_type', 'model_id'], 'media_model_type_model_id_index');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->nullable();
        });

        Schema::table('cars', function (Blueprint $table) {
            $table->string('status')->change();
            $table->decimal('price', 5, 2)->change();
        });
    }
};