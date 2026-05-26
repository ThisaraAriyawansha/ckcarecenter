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
        // Clear old pivot data (was linked to users, now linking to guardians)
        \DB::table('client_guardian')->truncate();

        Schema::table('client_guardian', function (Blueprint $table) {
            // FIRST: Drop the foreign key constraint
            $table->dropForeign(['user_id']);
            
            // SECOND: Drop the column
            $table->dropColumn('user_id');
            
            // THIRD: Add the new foreign key column
            $table->foreignId('guardian_id')->constrained('guardians')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('client_guardian', function (Blueprint $table) {
            // FIRST: Drop the guardian_id foreign key constraint
            $table->dropForeign(['guardian_id']);
            
            // SECOND: Drop the guardian_id column
            $table->dropColumn('guardian_id');
            
            // THIRD: Re-add user_id with foreign key constraint
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
        });
    }
};