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
        Schema::create('career_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // The career
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete(); // Career's branch
            $table->date('date');
            $table->time('time_in');
            $table->time('time_out')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete(); // Manager who approved
            $table->timestamp('approved_at')->nullable();
            $table->text('notes')->nullable(); // Career's notes
            $table->text('manager_notes')->nullable(); // Manager's notes
            $table->timestamps();

            // One attendance entry per career per day
            $table->unique(['user_id', 'date'], 'unique_career_date');

            // Index for querying
            $table->index('date');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_attendances');
    }
};
