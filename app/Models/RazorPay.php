<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RazorPay extends Model
{
    use HasFactory;

    public $fillable = [
        'admin_id', 'plan_id', 'razorpay_payment_id', 'entity', 'amount', 'currency', 'status', 'order_id', 'invoice_id', 'international', 'method', 'amount_refunded', 'refund_status', 'captured', 'description', 'card_id', 'bank', 'wallet', 'vpa', 'fee', 'tax', 'error_code', 'error_description', 'error_source',
        'error_step', 'error_reason'
    ];

    public function razorpays()
    {
        return $this->hasMany(Plan::class, 'plan_id');
    }
}
