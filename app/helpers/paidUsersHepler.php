<?php

use App\Models\Payment;
use Carbon\Carbon;

if (!function_exists('paidUsers')) {
    function paidUsers()
    {
        $payments = Payment::with('user', 'plan')
            ->orderBy('created_at', 'desc')
            ->get();

        $paidUsers = [];

        foreach ($payments as $payment) {
            $paidPaymentDate = $payment->expiry_date;
            $paidExpireDate = Carbon::createFromFormat('d-m-Y H:i:s', $paidPaymentDate);
            $currentDate = Carbon::now('Asia/Kolkata');
            if ($paidExpireDate >= $currentDate) {
                $paidUsers[] = $payment;
            } else {
                $payment->update([
                    'contact' => null
                ]);
            }

            // dump($payment);
        }

        // Dump the array of paid users
        return $paidUsers;
    }
}
