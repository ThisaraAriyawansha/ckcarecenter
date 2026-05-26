<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('title_slug')->nullable()->after('title');
            $table->unique('title_slug');           // optional but strongly recommended
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropUnique(['title_slug']);
            $table->dropColumn('title_slug');
        });
    }
};
