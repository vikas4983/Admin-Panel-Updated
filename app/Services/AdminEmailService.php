<?php
/// app/Services/AdminEmailService.php

namespace App\Services;

use App\Mail\Email; // Ensure correct namespace and class name
use Illuminate\Support\Facades\Config;
use App\Models\EmailSetting;
use Illuminate\Support\Facades\Mail;

class AdminEmailService
{


    public function configureMailer($admin, $functionName)
    {  
       // dump($admin, $functionName);
        
          if($functionName === "loginWithOTP") {
           $type = [
            'title' => 'Mail from MMM',
            'type' => 'login',
         ];
          }
          if($functionName ==="resendOTP") {
           $type = [
            'title' => 'Mail from MMM',
            'type' => 'resend',
         ];
          }
          if($functionName ==="forgetOTP") {
           $type = [
            'title' => 'Mail from MMM',
            'type' => 'forgot',
         ];
          }

        Mail::to($admin->email)->send(new Email($admin, $type));
        //return view('emails.email');
    
}
}
