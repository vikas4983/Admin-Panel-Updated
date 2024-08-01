<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class EmailController extends Controller
{

    public function sendWelcomeEmail()
    {
        try {
            // ... your existing code ...
            $userEmail = Auth::user();
            //dd($userEmail);
            
            Mail::to($userEmail)->send(new WelcomeEmail($userEmail));
            Log::info('Email sent successfully');
            return view('emails.welcome', compact('userEmail'));
        } catch (\Exception $e) {
            Log::error('Error sending email: ' . $e->getMessage());
            // Handle the exception or log more details
            return view('emails.error');
        }
    }
}
