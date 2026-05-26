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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->date('expense_date');
            $table->string('category'); // Main category: Groceries, Laundry, Cleaning, Transport, Bills, House Rent, Services, Medical, Salaries, Marketing, Monthly Settlement, Other, Capital, Refund
            $table->string('sub_category')->nullable(); // Sub-category: e.g., for Groceries (Supermarket, Shops), for Bills (Electricity, Water, Mobile, Other)
            $table->decimal('amount', 12, 2);
            $table->string('payment_method')->nullable(); // Cash, Bank Transfer, Card, etc.
            $table->string('vendor_name')->nullable();
            $table->string('receipt_number')->nullable();
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();

            $table->index('expense_date');
            $table->index('category');
            $table->index('branch_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
