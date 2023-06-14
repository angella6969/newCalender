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
      Schema::create('event_s_p_p_d_s', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('asal')->nullable();
            $table->string('tujuan')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('category')->nullable();
            $table->text('output')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_s_p_p_d_s');
    }
};
