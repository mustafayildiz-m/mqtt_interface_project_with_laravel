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
        Schema::create('allowed_user_and_workspaces', function (Blueprint $table) {
            $table->id();
            $table->integer('allowed_user_id')->nullable();
            $table->integer('allowed_workspace_id')->nullable();
            $table->string('allowed_email')->nullable();
            $table->string('register_code')->nullable();
            $table->string('allowed_device_serial_no')->nullable();
            $table->enum('user_role', ['admin', 'user', 'owner'])->default('owner');
            $table->boolean('is_register')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allowed_user_and_workspaces');
    }
};
