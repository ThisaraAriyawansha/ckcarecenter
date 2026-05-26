<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('care_homes', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->string('subtitle', 150)->nullable();
            $table->string('location', 150)->nullable();
            $table->text('description')->nullable();
            $table->string('image_path', 255)->nullable();
            $table->string('contact_no', 30)->nullable();
            $table->string('badge_text', 50)->nullable();
            $table->boolean('is_public')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('care_homes');
    }
};