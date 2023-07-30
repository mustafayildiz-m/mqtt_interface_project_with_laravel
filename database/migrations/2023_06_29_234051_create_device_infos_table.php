<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('device_infos', function (Blueprint $table) {
            $table->id();
            $table->string('serial_no')->nullable();
            $table->string('product_brand')->nullable();
            $table->string('hostname')->nullable();
            $table->string('ethernet_mac')->nullable();
            $table->string('wifi_mac')->nullable();
            $table->string('hardware_version')->nullable();
            $table->string('firmware_version')->nullable();
            $table->string('mqtt_url')->nullable();
            $table->string('mqtt_port')->nullable();
            $table->string('connection_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_infos');
    }
};
