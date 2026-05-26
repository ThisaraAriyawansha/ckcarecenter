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
        Schema::create('doctor_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('doctor_id')->constrained('users')->cascadeOnDelete(); // Doctor user
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->date('note_date');
            $table->text('notes');
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete(); // Manager who created
            $table->timestamps();

            // Indexes for querying
            $table->index('client_id');
            $table->index('doctor_id');
            $table->index('note_date');
            $table->index('branch_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_notes');
    }
};
