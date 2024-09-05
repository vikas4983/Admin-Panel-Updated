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
        Schema::create('model_counts', function (Blueprint $table) {
            $table->id();
            $table->string('modal_name')->nullable();  
            $table->string('route_name')->nullable();  
            $table->string('url')->nullable();         
            $table->integer('count')->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_counts');
    }
};
