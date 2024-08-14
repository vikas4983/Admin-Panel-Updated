<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Mail\email;
use App\Services\AdminEmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    protected $AdminEmailService;
    public function __construct(AdminEmailService $AdminEmailService)
    {
        $this->AdminEmailService = $AdminEmailService;
        
    }


    public function loginWithOTP(){

        $details = [
            'title' => 'Mail from MMM',
            'type'=> 'login',
            'name'=> 'Vikas',
        ];
       //dd($admin);
      
       //$this->AdminEmailService->email();
         
        // return "Email send";
         return "send email";

    }
    public function forgotOTP(){

        $admin = [
            'title' => 'Mail from MMM',
            'type'=> 'forgot',
            'name'=> 'Vikas',
            
        ];
       
       
         Mail::to('mmmdata2022@gmail.com')->send(new email($admin));
        // return "Email send";
         return view('emails.login-with-otp');

    }
    public function resendOTP(){

        $admin = [
            'title' => 'Mail from MMM',
            'type'=> 'resend',
            'name'=> 'Vikas',
        ];
    
         Mail::to('mmmdata2022@gmail.com')->send(new email($admin));
        // return "Email send";
         return view('emails.login-with-otp');

    }


}
