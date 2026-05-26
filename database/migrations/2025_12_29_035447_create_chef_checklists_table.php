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
        Schema::create('chef_checklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chef_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('manager_id')->nullable()->constrained('users')->nullOnDelete();
            $table->date('date');
            $table->string('week_number')->nullable();
            $table->string('month');

            // Daily Tasks - Dining
            $table->json('dining_tasks')->nullable(); // M, T, W, T, F, S, S checkboxes

            // Daily Tasks - Kitchen & Dinning
            $table->json('kitchen_dinning_tasks')->nullable();

            // Daily Tasks - Bathrooms
            $table->json('bathroom_tasks')->nullable();

            // Daily Tasks - Common Areas
            $table->json('common_area_tasks')->nullable();

            // Chef's signature
            $table->boolean('chef_signed')->default(false);
            $table->timestamp('chef_signed_at')->nullable();

            // Manager's signature
            $table->boolean('manager_signed')->default(false);
            $table->timestamp('manager_signed_at')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();

            // Ensure one checklist per chef per day
            $table->unique(['chef_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chef_checklists');
    }
};
