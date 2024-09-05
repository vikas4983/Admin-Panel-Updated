<?php

namespace App\Traits;

use App\Models\Payment;
use App\Models\SpoteLight;
use Carbon\Carbon;


trait paidUsersTrait
{
    

    public function paidUsers()
    {
        // Get all payments with user and plan relationships
        $payments = Payment::with('user.spotelights','plan')
        ->orderBy('created_at', 'desc')
        ->get();

        $paidUsers = [];
        $userIds = []; 

        foreach ($payments as $payment) {
            $paidPaymentDate = Carbon::parse($payment->expiry_date);
            $currentDate = Carbon::now('Asia/Kolkata');
             if ($paidPaymentDate >= $currentDate) {
                if (!in_array($payment->user_id, $userIds)) {
                    $paidUsers[] = $payment; 
                    $userIds[] = $payment->user_id; 
                }
            } else {
                $payment->update([
                    'contact' => null,
                    'is_paid' => 0
                ]);
            }
        }

        return $paidUsers;
    }


    
}











