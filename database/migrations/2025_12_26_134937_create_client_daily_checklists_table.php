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
        Schema::create('client_daily_checklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->string('category'); // DRESSING & PERSONAL HYGIENE, COMPANIONSHIP, HEALTH & MEDI MANAGEMENT, EATING & NUTRITION
            $table->string('task_key'); // Unique identifier for the task
            $table->string('task_name');
            $table->enum('day_of_week', ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'])->nullable();
            $table->boolean('completed')->default(false);
            $table->foreignId('completed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('completed_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            // Ensure one entry per client per task per date
            $table->unique(['client_id', 'date', 'task_key'], 'unique_client_task_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_daily_checklists');
    }
};
