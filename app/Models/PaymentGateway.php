<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    use HasFactory;

    public $fillable=['name', 'razorpay_key', 'salt', 'merchant_id', 'merchant_key', 'bank_name', 'account_name','bank_account_number', 'bank_account_type', 'bank_ifsc','status'];
}
