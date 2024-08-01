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
        Schema::create('contact_details', function (Blueprint $table) {
            $table->id();
            $table->string('alternate_email');
            $table->string('name_of_owner_primary_number');
            $table->integer('relationship_primary_number');
            $table->integer('alternate_number');
            $table->string('landline_number');
            $table->integer('name_of_owner_alternate_number');
            $table->integer('relationship_alternate_number');
            $table->string('call_time');
            $table->string('pin_code');
            $table->string('parent_address');
            $table->string('parent_pin_code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_details');
    }
};
