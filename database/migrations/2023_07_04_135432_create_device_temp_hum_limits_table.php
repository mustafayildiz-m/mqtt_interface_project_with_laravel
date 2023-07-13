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
        Schema::create('device_temp_hum_limits', function (Blueprint $table) {
            $table->id();
            $table->string('serial_no');
            $table->integer('temp_min')->default(15);
            $table->integer('temp_max')->default(40);
            $table->integer('crit_temp_min')->default(15);
            $table->integer('crit_temp_max')->default(40);
            $table->integer('moisture_min')->default(15);
            $table->integer('moisture_max')->default(40);
            $table->integer('crit_moisture_min')->default(15);
            $table->integer('crit_moisture_max')->default(40);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_temp_hum_limits');
    }
};
