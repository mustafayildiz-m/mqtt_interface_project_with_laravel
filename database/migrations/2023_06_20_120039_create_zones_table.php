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
        Schema::create('zones', function (Blueprint $table) {
            $table->id();
            $table->integer('work_space_id');
            $table->integer('parent_id')->nullable();
            $table->string('name');
            $table->string('img_url')->nullable();
            $table->timestamps();
            $table->foreign('parent_id')
                ->references('id')
                ->on('zones')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zones');
    }
};
