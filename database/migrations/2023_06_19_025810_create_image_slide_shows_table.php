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
        Schema::create('image_slide_shows', function (Blueprint $table) {
            $table->id();
            $table->string('filename')->nullable();
            $table->string('filepath')->nullable();
            $table->foreignId('event_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_slide_shows');
    }
};
