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
        // Clear existing image paths before changing column type
        \DB::table('clients')->update(['image' => null]);

        Schema::table('clients', function (Blueprint $table) {
            // Change image column from string to unsignedBigInteger for Curator
            $table->unsignedBigInteger('image')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            // Revert back to string
            $table->string('image')->nullable()->change();
        });
    }
};
