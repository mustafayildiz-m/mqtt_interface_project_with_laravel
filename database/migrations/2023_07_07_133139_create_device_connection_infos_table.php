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
        Schema::create('device_connection_infos', function (Blueprint $table) {
            $table->id();
            $table->string('serial_no');
            $table->string('ssid');
            $table->string('pass');
            $table->string('submask');
            $table->string('gateway');
            $table->string('dns');
            $table->enum('connection_type', ['ethernet', 'wifi']);
            $table->enum('connection_status', ['auto', 'manuel']);
            $table->enum('ip_set', [true, false]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_connection_infos');
    }
};
