<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\OTPMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginWithOTPController extends Controller
{
    // use AuthenticatesUsers;

    public function sendOTP(Request $request)
    {
        $valiadateData = $request->validate([
            'email' => ['required', 'email']
        ]);

        $admin = User::where('email', $valiadateData)->first();

        if ($admin) {
            $email = $admin->email;
            $password = $admin->password;
            $OTP = rand(1000, 9999);
            //$hashOTP = hash::make(rand(1000,9999));

            session(['OTP' => $OTP]);
            session(['email' => $email]);
            session(['password' => bcrypt($password)]);
            Mail::to($email)->send(new OTPMail($OTP));
            $msg = "OTP Send in Your Email Addredss Successfully!";
           return view('auth.verifyForm', compact('admin'))->with('error', $msg);
        } else {
            $msg = "Email Is  Not Validate With Our Record!";
            return redirect()->back()->with('error', $msg);
        }
    }

    public function verifyForm()
    {

        return view('auth.verifyForm');
    }
    
    public function verifyOTP(Request $request)
    {
        $OTP = session('OTP');
        $email = session('email');
        $password = session('password');
        $verifyOTP = $request->otp;
        $verifyEmail = $request->email;

        dump($OTP, $email, $password, $verifyOTP, $verifyEmail);

        if ($verifyOTP == $OTP) {
            $credentials = [
                'email' => $email,
                'password' => $password,
            ];
            dump($credentials);


            try {

                // Authenticating the user
                $response = Auth::attempt($credentials);
                return $response;
            } catch (\Throwable $th) {
                //throw $th;
                dd($th->getMessage());
            }

            // Custom logic for failed login attempt
            // return $this->sendFailedLoginResponse($credentials);

            if (Auth::attempt($credentials)) {
                return "success";
            } else {
                return "failed";
            }
        } else {
            return "b";
        }
    }
}
