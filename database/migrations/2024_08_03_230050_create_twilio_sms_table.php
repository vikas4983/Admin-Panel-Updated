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
        Schema::create('twilio_sms', function (Blueprint $table) {
            $table->id();
            $table->string('sid');
            $table->string('token');
            $table->string('from_number');
            $table->string('status');
            $table->string('demo1');
            $table->string('demo2');
            $table->string('demo3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('twilio_sms');
    }
};
