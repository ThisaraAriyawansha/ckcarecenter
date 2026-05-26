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
        Schema::create('payslips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_id')->constrained()->cascadeOnDelete();
            $table->string('payslip_number')->unique();
            $table->integer('month'); // 1-12
            $table->integer('year');
            $table->date('payment_date');

            // Salary details
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('allowances', 10, 2)->default(0);
            $table->decimal('overtime', 10, 2)->default(0);
            $table->decimal('bonus', 10, 2)->default(0);
            $table->decimal('gross_salary', 10, 2);

            // Deductions
            $table->decimal('epf_employee', 10, 2)->default(0); // 8% employee contribution
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('other_deductions', 10, 2)->default(0);
            $table->decimal('total_deductions', 10, 2);

            // Net salary
            $table->decimal('net_salary', 10, 2);

            // Status
            $table->enum('status', ['draft', 'sent', 'paid'])->default('draft');
            $table->timestamp('sent_at')->nullable();
            $table->foreignId('generated_by')->nullable()->constrained('users')->nullOnDelete();

            // Notes
            $table->text('notes')->nullable();

            $table->timestamps();

            // Unique constraint for career, month, year
            $table->unique(['career_id', 'month', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payslips');
    }
};
