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
        Schema::create('horoscope_details', function (Blueprint $table) {
            $table->id();
            $table->string('time_of_birth');
            $table->integer('manglik');
            $table->string('city_of_birth');
            $table->integer('rashi');
            $table->integer('horoscope_match');
            $table->integer('horoscope_show');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horoscope_details');
    }
};
