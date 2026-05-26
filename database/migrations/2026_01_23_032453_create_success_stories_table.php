// database/migrations/xxxx_create_success_stories_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('success_stories', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image');
            $table->string('image_alt')->nullable();
            $table->enum('layout_type', ['single', 'paired_left', 'paired_right'])->default('single');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['sort_order', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('success_stories');
    }
};