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
        Schema::create('like_details', function (Blueprint $table) {
            $table->id();
            $table->integer('hobby');
            $table->integer('interest');
            $table->integer('music');
            $table->integer('dress');
            $table->integer('movie');
            $table->integer('sport');
            $table->string('favourite_book');
            $table->string('favourite_read');
            $table->string('favourite_movie');
            $table->string('show');
            $table->string('cuisine');
            $table->string('food_cook');
            $table->string('vacation_destination');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('like_details');
    }
};
