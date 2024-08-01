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
        Schema::create('pay_u_money', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id');
            $table->foreignId('plan_id');
            $table->string('mihpayid');
            $table->string('amount');
            $table->string('paid');
            $table->string('mode');
            $table->string('txnid');
            $table->string('productinfo');
            $table->string('hash');
            $table->string('payuMoneyId');
            $table->string('status');
            $table->string('paymentText');
            $table->string('giftCardIssued');
            $table->string('bank_ref_num');
            $table->string('bankcode');
            $table->string('error');
            $table->string('error_Message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_u_money');
    }
};
