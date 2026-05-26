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
        Schema::create('medication_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medication_id')->constrained()->cascadeOnDelete();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->enum('time_of_day', ['morning', 'afternoon', 'evening']);
            $table->boolean('given')->default(false);
            $table->foreignId('given_by')->nullable()->constrained('users')->nullOnDelete();
            $table->time('given_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            // Unique constraint to prevent duplicate records
            $table->unique(['medication_id', 'date', 'time_of_day']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medication_records');
    }
};
