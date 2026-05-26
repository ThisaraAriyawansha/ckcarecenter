<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');                    
            $table->text('description')->nullable();    // details
            $table->date('event_date');                 // main date
            $table->time('event_time')->nullable();     // start time
            $table->string('location')->nullable();     // optional: Garden, TV Room, etc.
            $table->integer('order')->default(0);       // for manual reordering
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};