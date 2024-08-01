<?php

namespace App\Traits;

use App\Models\Payment;
use App\Models\SpoteLight;
use Carbon\Carbon;

trait PaidUsersTrait
{
    public function paidUsers()
    {
        // Get all payments with user and plan relationships
        $payments = Payment::with('user.spotelights','plan')
        ->orderBy('created_at', 'desc')
        ->get();

        $paidUsers = [];
        $userIds = []; // To keep track of processed user IDs

        foreach ($payments as $payment) {
            $paidPaymentDate = Carbon::parse($payment->expiry_date);
            $currentDate = Carbon::now('Asia/Kolkata');
             // Check if the payment is still valid
            if ($paidPaymentDate >= $currentDate) {
                // Check if the user has already been added
                if (!in_array($payment->user_id, $userIds)) {
                    $paidUsers[] = $payment; // Add the payment (with user)
                    $userIds[] = $payment->user_id; // Mark this user as processed
                }
            } else {
                // Update expired payments
                $payment->update([
                    'contact' => null,
                    'is_paid' => 0
                ]);
                

            }
        }

        return $paidUsers;
    }


    
}











