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
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('alternative_phone')->nullable();
            $table->text('address')->nullable();
            $table->enum('joining_potential', ['level_1', 'level_2', 'level_3', 'level_4'])
                ->comment('Level 1: High Priority, Level 2: Medium Priority, Level 3: Low Priority, Level 4: Very Low Priority');
            $table->text('requirements')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['new', 'contacted', 'scheduled', 'converted', 'not_interested', 'follow_up'])
                ->default('new');
            $table->date('follow_up_date')->nullable();
            $table->foreignId('handled_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
