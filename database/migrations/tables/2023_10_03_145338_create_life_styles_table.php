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
        Schema::create('life_styles', function (Blueprint $table) {
            $table->id();
            $table->integer('body_type');
            $table->integer('weight');
            $table->integer('complextion');
            $table->integer('dietary_habit');
            $table->integer('drinking_habit');
            $table->integer('smoking_habit');
            $table->integer('challenge');
            $table->string('open_to_pet');
            $table->string('own_house');
            $table->string('own_car');
            $table->integer('language_speak');
            $table->string('hiv+');
            $table->string('thalassemia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('life_styles');
    }
};
