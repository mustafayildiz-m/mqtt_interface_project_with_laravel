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
        Schema::create('ethernet_dynamics', function (Blueprint $table) {
            $table->id();
            $table->string('serial_no')->nullable();
            $table->string('ip')->nullable();
            $table->string('submask')->nullable();
            $table->string('gateway')->nullable();
            $table->string('dns')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ethernet_dynamics');
    }
};
