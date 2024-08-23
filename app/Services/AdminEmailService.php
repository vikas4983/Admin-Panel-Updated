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
        //dd($name);
        
         //  if($functionName === "loginWithOTP") {
         //   $type = [
         //    'subject' => 'Login',
         //    'type' => 'login',
         // ];
         //  }
         //  if($functionName ==="resendOTP") {
         //   $type = [
         //    'subject' => 'Resend',
         //    'type' => 'resend',
         // ];
         //  }
         //  if($functionName ==="forgetOTP") {
         //   $type = [
         //    'subject' => 'Forgot',
         //    'type' => 'forgot',
         // ];
         //  }

        Mail::to($admin->email)->send(new Email($admin,$emailTemplate));
        //return view('emails.email');
    
}
}
