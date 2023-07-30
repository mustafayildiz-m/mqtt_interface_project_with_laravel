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
        Schema::create('device_connection_infos', function (Blueprint $table) {
            $table->id();
            $table->string('serial_no');
            $table->string('ssid')->nullable();
            $table->string('ip')->nullable();
            $table->string('password')->nullable();
            $table->string('submask')->nullable();
            $table->string('gateway')->nullable();
            $table->string('dns')->nullable();
            $table->string('port')->nullable();
            $table->string('hostname')->nullable();
            $table->string('connection_type')->nullable();
            $table->enum('encryption', ['WEP','WPA', 'WPA2','WPA3',])->default('WPA2');
            $table->boolean('ip_set', [true, false])->default(false); //false gelirse dynamic seçili true gelirse static olacak
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
