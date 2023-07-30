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
            $table->float('temp_min')->default(18);
            $table->float('temp_max')->default(27);
            $table->float('crit_temp_min')->default(15);
            $table->float('crit_temp_max')->default(30);
            $table->float('moisture_min')->default(55);
            $table->float('moisture_max')->default(70);
            $table->float('crit_moisture_min')->default(45);
            $table->float('crit_moisture_max')->default(80);
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
