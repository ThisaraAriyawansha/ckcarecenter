<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('title_slug', 120)->unique();
            $table->decimal('price_lkr', 10, 2);
            $table->decimal('price_usd', 10, 2);
            $table->string('currency', 10)->default('LKR');
            $table->string('room_type', 50);
            $table->integer('sharing_capacity')->default(2);
            $table->enum('bathroom_type', ['ensuite', 'shared', 'mixed'])->default('mixed');
            $table->enum('status', ['active', 'inactive', 'archived'])->default('active');
            $table->timestamps();
            
            $table->index('title_slug');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};