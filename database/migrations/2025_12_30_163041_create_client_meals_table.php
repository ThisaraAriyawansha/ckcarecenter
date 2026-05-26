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
        Schema::create('client_meals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->date('meal_date');
            $table->time('meal_time');
            $table->enum('meal_type', ['breakfast', 'lunch', 'dinner', 'snack'])->default('lunch');
            $table->text('meal_items'); // What was served
            $table->text('notes')->nullable(); // Additional notes
            $table->unsignedBigInteger('recorded_by')->nullable(); // Carer who recorded
            $table->timestamps();

            // Index for querying
            $table->index(['client_id', 'meal_date']);
            $table->foreign('recorded_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_meals');
    }
};
