<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            // Meta title
            if (!Schema::hasColumn('blogs', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('title_slug');
            }

            // Meta description
            if (!Schema::hasColumn('blogs', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }

            // Meta keywords
            if (!Schema::hasColumn('blogs', 'meta_keywords')) {
                $table->string('meta_keywords')->nullable()->after('meta_description');
            }

            // Category ID + FK
            if (!Schema::hasColumn('blogs', 'category_id')) {
                $table->unsignedBigInteger('category_id')->nullable()->after('meta_keywords');
            }

            // Add FK only if column exists and FK doesn't (safe)
            $foreignKeyName = 'blogs_category_id_foreign';
            if (Schema::hasColumn('blogs', 'category_id') && !Schema::hasForeignKey('blogs', $foreignKeyName)) {
                $table->foreign('category_id')
                      ->references('id')
                      ->on('categories')
                      ->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $foreignKeyName = 'blogs_category_id_foreign';

            if (Schema::hasForeignKey('blogs', $foreignKeyName)) {
                $table->dropForeign($foreignKeyName);
            }

            $columns = ['category_id', 'meta_keywords', 'meta_description', 'meta_title'];

            foreach ($columns as $column) {
                if (Schema::hasColumn('blogs', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};