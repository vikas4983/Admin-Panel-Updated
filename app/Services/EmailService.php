<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use App\Mail\RegisteredAdmin;

class EmailService
{
    public function sendMail($admin, $emailTemplate)
    {
       Mail::to($admin->email)->send(new RegisteredAdmin($admin, $emailTemplate));
    }
}
