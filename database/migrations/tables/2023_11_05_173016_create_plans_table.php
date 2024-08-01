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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('image')->default(null);
            $table->string('name');
            $table->string('duration');
            $table->string('price');
            $table->string('offer');
            $table->string('offer_price');
            $table->string('per_month');
            $table->string('saving');
            $table->string('allow_contact');
            $table->string('chat');
            $table->string('video_call');
            $table->string('message');
            $table->string('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
