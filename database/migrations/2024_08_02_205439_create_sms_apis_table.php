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
        Schema::create('sms_apis', function (Blueprint $table) {
            $table->id();
            $table->string('api_id')->nullable();
            $table->string('api_password')->nullable();
            $table->string('sms_type')->nullable();
            $table->string('sms_encoding')->nullable();
            $table->string('sender')->nullable();
            $table->string('number')->nullable();
            $table->string('message')->nullable();
            $table->string('template_id')->nullable();
            $table->string('demo1')->nullable();
            $table->string('demo2')->nullable();
            $table->string('demo3')->nullable();
            $table->string('demo4')->nullable();
            $table->string('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sms_apis');
    }
};
