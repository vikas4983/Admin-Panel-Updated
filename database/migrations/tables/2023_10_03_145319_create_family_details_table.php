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
        Schema::create('family_details', function (Blueprint $table) {
            $table->id();
            $table->integer('father_occupation');
            $table->integer('mother_occupation');
            $table->string('brother');
            $table->string('brother_married');
            $table->string('sister');
            $table->string('sister_married');
            $table->string('family_living');
            $table->string('father_gotra');
            $table->string('mother_gotra');
            $table->string('contact_address');
            $table->string('about_family');
            $table->integer('family_type');
            $table->integer('family_value');
            $table->integer('family_status');
            $table->string('native_place');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_details');
    }
};
