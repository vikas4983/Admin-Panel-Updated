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
        Schema::create('razor_pays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id');
            $table->foreignId('plan_id');
            $table->string('razorpay_payment_id');
            $table->string('entity');
            $table->string('amount');
            $table->string('currency');
            $table->string('status');
            $table->string('order_id')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('international');
            $table->string('method');
            $table->string('amount_refunded');
            $table->string('refund_status')->nullable();
            $table->string('captured');
            $table->string('description');
            $table->string('card_id')->nullable();
            $table->string('bank')->nullable();
            $table->string('wallet');
            $table->string('vpa')->nullable();
            $table->string('fee')->nullable();
            $table->string('tax')->nullable();
            $table->string('error_code')->nullable();
            $table->string('error_description')->nullable();
            $table->string('error_source')->nullable();
            $table->string('error_step')->nullable();
            $table->string('error_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('razor_pays');
    }
};
