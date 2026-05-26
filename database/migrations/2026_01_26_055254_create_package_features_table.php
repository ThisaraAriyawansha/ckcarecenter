<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('package_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            $table->string('feature_key', 50);
            $table->string('feature_label', 100);
            $table->string('feature_value', 255);
            $table->string('icon_class', 50)->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('is_highlight')->default(false);
            $table->timestamps();
            
            $table->unique(['package_id', 'feature_key']);
            $table->index('package_id');
            $table->index('feature_key');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('package_features');
    }
};