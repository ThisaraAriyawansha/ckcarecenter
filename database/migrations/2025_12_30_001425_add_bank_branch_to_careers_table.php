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
        Schema::table('careers', function (Blueprint $table) {
            $table->string('bank_branch')->nullable()->after('bank_sort_code');
            $table->dropColumn('bank_sort_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('careers', function (Blueprint $table) {
            $table->dropColumn('bank_branch');
            $table->string('bank_sort_code')->nullable()->after('bank_account_number');
        });
    }
};
