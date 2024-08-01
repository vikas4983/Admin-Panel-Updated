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
        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->boolean('about_me')->default(0)->nullable();
            $table->boolean('about_education')->default(0)->nullable();
            $table->boolean('about_Occupation')->default(0)->nullable();
            $table->boolean('about_family')->default(0)->nullable();
            $table->boolean('read_carefully')->default(0)->nullable();
            $table->string('success_story')->default(0)->nullable();
            $table->boolean('image1')->default(0)->nullable();
            $table->boolean('image2')->default(0)->nullable();
            $table->boolean('image3')->default(0)->nullable();
            $table->boolean('image4')->default(0)->nullable();
            $table->boolean('image5')->default(0)->nullable();
            $table->boolean('image6')->default(0)->nullable();
            $table->boolean('status')->default(0)->nullable();
            $table->boolean('demo1')->default(0)->nullable();
            $table->boolean('demo2')->default(0)->nullable();
            $table->boolean('demo3')->default(0)->nullable();
            $table->boolean('demo4')->default(0)->nullable();
            $table->boolean('demo5')->default(0)->nullable();
            $table->boolean('demo6')->default(0)->nullable();
            $table->boolean('demo7')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvals');
    }
};
