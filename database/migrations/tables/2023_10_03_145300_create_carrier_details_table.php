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
        Schema::create('carrier_details', function (Blueprint $table) {
            $table->id();
            $table->integer('city');
            $table->integer('education');
            $table->integer('employee');
            $table->integer('occupation');
            $table->integer('income');
            $table->string('about_you');
            $table->string('school_name');
            $table->string('college_name');
            $table->string('organization_name');
            $table->string('interested_abroad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrier_details');
    }
};
