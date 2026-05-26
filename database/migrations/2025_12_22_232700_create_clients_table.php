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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('reg_number')->unique();
            $table->date('date');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('name');
            $table->integer('age');
            $table->date('dob');
            $table->text('co_morbidities_risk_factors')->nullable();
            $table->decimal('height_cm', 5, 2)->nullable();
            $table->decimal('weight_kg', 5, 2)->nullable();
            $table->decimal('bmi', 5, 2)->nullable();
            $table->decimal('waist_circumference', 5, 2)->nullable();
            $table->decimal('hip_circumference', 5, 2)->nullable();
            $table->foreignId('officer_in_charge_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // Pivot table for multiple guardians
        Schema::create('client_guardian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_guardian');
        Schema::dropIfExists('clients');
    }
};
