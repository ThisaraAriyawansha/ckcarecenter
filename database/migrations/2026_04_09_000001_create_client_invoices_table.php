<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->string('invoice_number')->unique();
            $table->enum('type', ['invoice', 'quotation'])->default('invoice');
            $table->date('invoice_date');
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);
            $table->text('remarks')->nullable();
            $table->string('bank_ac_name')->default('Care 365 Pvt LTD');
            $table->string('bank_ac_number_lkr')->default('20410016001643 LKR');
            $table->string('bank_ac_number_usd')->nullable()->default('20440216001643 USD');
            $table->string('bank_name')->default("People's Bank");
            $table->string('bank_branch')->default('Head Quarters Branch');
            $table->boolean('email_sent')->default(false);
            $table->timestamp('email_sent_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('client_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('client_invoices')->cascadeOnDelete();
            $table->string('item_name');
            $table->string('description')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('amount', 12, 2)->default(0);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_invoice_items');
        Schema::dropIfExists('client_invoices');
    }
};
