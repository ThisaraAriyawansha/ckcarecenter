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
        Schema::create('client_outings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->time('time_out');
            $table->time('time_in')->nullable();
            $table->text('reason');
            $table->string('destination')->nullable();
            $table->foreignId('accompanied_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('transport_mode')->nullable(); // e.g., Car, Wheelchair, Walking, Ambulance
            $table->enum('status', ['out', 'returned', 'cancelled'])->default('out');
            $table->text('notes')->nullable();
            $table->foreignId('authorized_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_outings');
    }
};
