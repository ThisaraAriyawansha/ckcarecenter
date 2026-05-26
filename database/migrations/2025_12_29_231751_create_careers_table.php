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
        Schema::create('careers', function (Blueprint $table) {
            $table->id();

            // Basic Information
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('employee_id')->unique();
            $table->string('full_name');
            $table->date('date_of_birth');
            $table->integer('age')->nullable();
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('nationality')->nullable();
            $table->string('national_id_number')->nullable();
            $table->string('passport_number')->nullable();

            // Contact Information
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('alternative_phone')->nullable();
            $table->text('current_address');
            $table->text('permanent_address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();

            // Emergency Contact
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_relationship');
            $table->string('emergency_contact_phone');
            $table->string('emergency_contact_alternative_phone')->nullable();

            // Employment Details
            $table->date('joining_date');
            $table->date('contract_start_date')->nullable();
            $table->date('contract_end_date')->nullable();
            $table->enum('employment_type', ['full_time', 'part_time', 'contract', 'temporary'])->default('full_time');
            $table->enum('employment_status', ['active', 'on_leave', 'suspended', 'terminated', 'resigned'])->default('active');
            $table->string('job_title')->nullable();
            $table->text('job_description')->nullable();
            $table->string('department')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('supervisor_id')->nullable()->constrained('users')->nullOnDelete();

            // Compensation
            $table->decimal('salary', 10, 2)->nullable();
            $table->enum('salary_type', ['hourly', 'daily', 'weekly', 'monthly', 'annual'])->default('monthly');
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_sort_code')->nullable();

            // Qualifications
            $table->string('highest_qualification')->nullable();
            $table->text('certifications')->nullable();
            $table->text('specialized_training')->nullable();
            $table->integer('years_of_experience')->nullable();
            $table->text('previous_employment')->nullable();

            // Medical & DBS
            $table->date('dbs_check_date')->nullable();
            $table->string('dbs_certificate_number')->nullable();
            $table->date('dbs_expiry_date')->nullable();
            $table->date('medical_check_date')->nullable();
            $table->date('medical_expiry_date')->nullable();
            $table->text('medical_conditions')->nullable();
            $table->text('allergies')->nullable();

            // Training & Compliance
            $table->date('induction_completed_date')->nullable();
            $table->date('fire_safety_training_date')->nullable();
            $table->date('first_aid_training_date')->nullable();
            $table->date('manual_handling_training_date')->nullable();
            $table->date('safeguarding_training_date')->nullable();
            $table->date('infection_control_training_date')->nullable();

            // Other
            $table->string('uniform_size')->nullable();
            $table->boolean('has_driving_license')->default(false);
            $table->string('driving_license_number')->nullable();
            $table->date('driving_license_expiry')->nullable();
            $table->boolean('has_own_vehicle')->default(false);
            $table->text('notes')->nullable();
            $table->string('profile_photo')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
