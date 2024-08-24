<?php
/// app/Services/AdminEmailService.php

namespace App\Services;

use App\Mail\Email; // Ensure correct namespace and class name
use Illuminate\Support\Facades\Config;
use App\Models\EmailSetting;
use Illuminate\Support\Facades\Mail;

class AdminEmailService
{


    public function configureMailer($admin, $emailTemplate)
    {  
        Mail::to($admin->email)->send(new Email($admin,$emailTemplate));
      
    
}
}
