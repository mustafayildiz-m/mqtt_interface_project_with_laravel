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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('device_name')->nullable();
            $table->integer('workspace_id')->default(0);
            $table->integer('zone_id')->default(0);
            $table->integer('notice_period')->default(30);
            $table->string('device_img')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('connection_type')->nullable();
            $table->string('master_key')->nullable();
            $table->enum('is_active', [0, 1])->default(0);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
