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
        Schema::create('car_items', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->year('year')->nullable();
            $table->string('milleage', 510)->nullable();
            $table->string('engine', 510)->nullable();
            $table->string('transmission', 510)->nullable();
            $table->string('drive_unit', 510)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_items');
    }
};
