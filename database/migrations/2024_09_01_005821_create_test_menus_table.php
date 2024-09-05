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
        Schema::create('test_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('super_menu_id')->nullable();
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->unsignedBigInteger('sub_menu_id')->nullable();
            $table->unsignedBigInteger('child_menu_id')->nullable();
            
            $table->timestamps();
    
            $table->foreign('super_menu_id')->references('id')->on('test_menus')->onDelete('cascade');
            $table->foreign('menu_id')->references('id')->on('test_menus')->onDelete('cascade');
            $table->foreign('sub_menu_id')->references('id')->on('test_menus')->onDelete('cascade');
            $table->foreign('child_menu_id')->references('id')->on('test_menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_menus');
    }
};
