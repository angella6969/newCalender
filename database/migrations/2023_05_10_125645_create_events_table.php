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
        // Schema::create('events', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('title');
        //     $table->date('start_date');
        //     $table->date('end_date');
        //     $table->string('category');
        //     $table->timestamps();
        // });
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('keperluan');
            $table->string('asal');
            $table->string('tujuan');
            $table->date('berangkat');
            $table->date('kembali');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
