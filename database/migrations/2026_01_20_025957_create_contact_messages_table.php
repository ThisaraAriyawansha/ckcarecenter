<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 255);
            $table->string('number', 20);
            $table->string('subject', 255);
            $table->text('message');
            $table->boolean('is_read')->default(false);     // ← admin check column
            // Optional extra columns
            $table->timestamp('read_at')->nullable();       // when admin marked as read
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};