<?php

namespace App\Traits;

use App\Models\Payment;
use App\Models\Plan;
use App\Models\User;
use Carbon\Carbon;


trait ActiveUsersTrait
{
    public function activeUsers()
    {
        $activeUsers = User::with(['payments.plan' => function ($query) {
            $query->orderBy('created_at', 'desc'); // Get the latest payment
        }])->where('status', 1)->
        orderBy('created_at', 'desc')->get();

        $plans = Plan::all();
      
        return $activeUsers;
    }
}
