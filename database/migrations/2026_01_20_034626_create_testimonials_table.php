<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('position', 100);
            $table->tinyInteger('rating')->unsigned()->default(5); // 1 to 5 stars
            $table->string('image_path', 255)->nullable();         // where we save image filename
            $table->boolean('is_public')->default(true);           // public = 1 / private = 0
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};