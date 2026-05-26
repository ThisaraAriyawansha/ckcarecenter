<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Step 1: Backup current data to a new table
        DB::statement('CREATE TABLE IF NOT EXISTS package_features_backup AS SELECT * FROM package_features');
        
        // Step 2: Get all current features to preserve
        $features = DB::table('package_features')->get();
        
        // Step 3: Drop the old table
        Schema::dropIfExists('package_features');
        
        // Step 4: Create new SIMPLE table
        Schema::create('package_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            $table->text('feature'); // Simple feature text
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['package_id', 'is_active']);
        });
        
        // Step 5: Insert data from old table (using feature_label as feature text)
        foreach ($features as $oldFeature) {
            DB::table('package_features')->insert([
                'id' => $oldFeature->id,
                'package_id' => $oldFeature->package_id,
                'feature' => $oldFeature->feature_label ?? 'Feature',
                'is_active' => true,
                'created_at' => $oldFeature->created_at,
                'updated_at' => $oldFeature->updated_at,
            ]);
        }
    }

    public function down(): void
    {
        // If you need to rollback, drop the simple table
        Schema::dropIfExists('package_features');
        
        // You could restore from backup if needed
        // DB::statement('CREATE TABLE package_features AS SELECT * FROM package_features_backup');
    }
};