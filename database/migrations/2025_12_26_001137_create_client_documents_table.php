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
        Schema::create('client_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('category'); // Agreement, Letter, Medical Record, ID Document, Insurance, Other
            $table->text('description')->nullable();
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_type')->nullable(); // pdf, doc, image, etc
            $table->integer('file_size')->nullable(); // in bytes
            $table->date('document_date')->nullable(); // Date of the document (e.g., agreement date)
            $table->date('expiry_date')->nullable(); // For documents that expire
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->boolean('is_confidential')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_documents');
    }
};
