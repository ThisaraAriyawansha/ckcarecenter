<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Create a temporary table to hold data
        Schema::create('package_features_temp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id');
            $table->text('feature'); // Simple feature text
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Copy data from old table to new table
        // Use feature_label as the feature text
        DB::insert('
            INSERT INTO package_features_temp (id, package_id, feature, is_active, created_at, updated_at)
            SELECT id, package_id, feature_label, 1, created_at, updated_at 
            FROM package_features
        ');

        // Drop the old complex table
        Schema::dropIfExists('package_features');

        // Rename temp table to original name
        Schema::rename('package_features_temp', 'package_features');

        // Add foreign key constraint
        Schema::table('package_features', function (Blueprint $table) {
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->index(['package_id', 'is_active']);
        });
    }

    public function down(): void
    {
        // For rollback, we'll recreate the original structure
        // But you probably won't need this
        
        // Backup current simple table
        Schema::create('package_features_simple_backup', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id');
            $table->text('feature');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::insert('
            INSERT INTO package_features_simple_backup 
            SELECT * FROM package_features
        ');

        // Drop simple table
        Schema::dropIfExists('package_features');

        // Recreate original structure (empty)
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
        });
    }
};