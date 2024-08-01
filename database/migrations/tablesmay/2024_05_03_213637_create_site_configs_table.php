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
        Schema::create('site_configs', function (Blueprint $table) {
            $table->id();
            $table->boolean('interest_setting')->default(0);
            $table->boolean('profile_view_setting')->default(0);
            $table->boolean('profile_name_setting')->default(0);
            $table->boolean('profile_activation')->default(0);
            $table->boolean('profile_photo_setting')->default(0);
            $table->boolean('profile_kyc_setting')->default(0);
            $table->string('success_story_year_setting');
            $table->string('male_legal_age');
            $table->string('female_legal_age');
            $table->boolean('status')->default(0);
            $table->string('demo1')->nullable();
            $table->string('demo2')->nullable();
            $table->string('demo3')->nullable();
            $table->string('demo4')->nullable();
            $table->string('demo5')->nullable();
            $table->string('demo6')->nullable();
          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_configs');
    }
};
