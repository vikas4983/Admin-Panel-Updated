<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayUMoney extends Model
{
    use HasFactory;

    public $fillable = [
        'admin_id',
        'plan_id',
        'mihpayid',
        'paid',
        'amount',
        'status',
        'paymentText',
        'mode',
        'txnid',
        'productinfo',
         'hash',
        'payuMoneyId',
        'giftCardIssued',
        'bank_ref_num',
        'bankcode',
        'error',
        'error_Message',
       
        
        
    ];
}
