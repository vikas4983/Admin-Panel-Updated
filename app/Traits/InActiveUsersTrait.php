<?php

namespace App\Traits;

use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;


trait InActiveUsersTrait
{
    public function inActiveUsers()
    {
        $inActiveUsers = User::where('status', 0)
            ->orderBy('created_at', 'desc')
            ->get();
           // dd($inActiveUsers);
        return $inActiveUsers;
    }
}
