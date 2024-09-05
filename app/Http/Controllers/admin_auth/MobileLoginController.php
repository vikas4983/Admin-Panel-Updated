<?php

namespace App\Http\Controllers\admin_auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\EmailTemplate;
use App\Models\MobileLogin;
use App\Services\AdminEmailService;
use App\Services\PhoneNumberService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\smsApiService;
use App\Services\TwilioSmsService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Jobs\SendEmailJob;

class MobileLoginController extends Controller
{
    protected $smsApiService;
    protected $SendEmailJob;

    protected $phoneNumberService;
    protected $TwilioSmsService;
    protected $AdminEmailService;
    public function __construct(AdminEmailService $AdminEmailService, smsApiService $smsApiService, phoneNumberService $phoneNumberService, TwilioSmsService $TwilioSmsService)
    {
        $this->smsApiService = $smsApiService;
        $this->phoneNumberService = $phoneNumberService;
        $this->TwilioSmsService = $TwilioSmsService;
        $this->AdminEmailService = $AdminEmailService;
    }
    public function showform()
    {
        return view('verify_otp');
    }

    public function loginWithOTP(Request $request)
    {
        $validateRequest = $request->validate([
            'mobile' => ['required', 'digits:10'],
            'LoginWithOTP' => ['required', 'string'],
        ]);
        $number = $validateRequest['mobile'];
        $name = $validateRequest['LoginWithOTP'];
        $admin = Admin::where('mobile', $number)->first();

        if (!$admin) {

            return redirect('admin-login')->with('error', " Admin not found!");
        }
        $otp = rand(1000, 9999);
        $latestOTP = MobileLogin::where('admin_id', $admin->id)->latest('id')->first();
        session(['latestOTP' => $latestOTP]);
        if (Session::has('latestOTP')) {
            $latestOTP->delete();
            return redirect('admin-login');
        }
        try {
            $currentDateTime = Carbon::now()->addMinutes(1);
            MobileLogin::create([
                'admin_id' => $admin->id,
                'otp' => $otp,
                'mobile' => $request->mobile,
                'expires_at' => $currentDateTime
            ]);


            $emailTemplate = EmailTemplate::where('status', 1)->where('name', $name)->first();
            SendEmailJob::dispatch($admin, $emailTemplate);
            $this->smsApiService->OTP($admin); // BulkSmsPlansApi
            $this->AdminEmailService->configureMailer($admin, $emailTemplate);
            //$this->TwilioSmsService->OTP($admin); // Twilio Api

            return view('verify_otp', [
                'admin' =>
                $admin,
                'success' => 'OTP has been sent successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }



    public function resendOTP(Request $request)
    {
        $validateRequest = $request->validate([
            'mobile' => ['required', 'digits:10'],
            'ResendOTP' => ['required', 'string'],

        ]);
        $mobile = $validateRequest['mobile'];
        $name = $validateRequest['ResendOTP'];

        try {

            $admin = Admin::where('mobile', $mobile)->first();
            if (!$admin) {
                return response()->json(['success' => false, 'error' => 'Admin not found!'], 404);
            }
            $otp = rand(1000, 9999);
            $currentDateTime = Carbon::now()->addMinutes(1);
            MobileLogin::where('admin_id', $admin->id)->delete();
            MobileLogin::create([
                'admin_id' => $admin->id,
                'otp' => $otp,
                'mobile' => $mobile,
                'expires_at' => $currentDateTime
            ]);
            $emailTemplate = EmailTemplate::where('status', 1)->where('name', $name)->first();

            $this->smsApiService->OTP($admin); // Using BulkSmsPlans API
            $this->AdminEmailService->configureMailer($admin, $emailTemplate);
            //$this->TwilioSmsService->resendOTP($admin); // Using Twilio API
            return  response()->json(['success' => true, 'message' => 'Resend OTP sent successfully!']);
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
    public function verifyOtp(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'mobile' => 'required|digits:10',
            'otp' => 'required|digits:4',
        ]);
        $mobileLogin = MobileLogin::where('mobile', $request->mobile)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();
        if (!$mobileLogin) {
            $admin = Admin::with(['otps' => function ($query) {
                $query->latest('id')->first();
            }])->first();
            return view('verify_otp', [
                'admin' => $admin,
                'error' => 'Incorrect OTP or OTP expired'
            ]);
        }
        $admin = Admin::where('mobile', $request->mobile)->first();
        Auth::guard('admin')->login($admin);
        $mobileLogin->delete();
        session()->forget('otp_sent');
        return redirect('admin/dashboard')->with('success', 'Logged in successfully');
    }

    public function forgetOTP(Request $request)
    {

        $validatedata = $request->validate([
            'mobile' => ['required', 'max:10'],
            'ForgotPassword' => ['required', 'string']
        ]);

        //Validate the Mail
        $name = $validatedata['ForgotPassword'];
        $emailTemplate = EmailTemplate::where('status', 1)->where('name', $name)->first();

        $admin = Admin::where('mobile', $validatedata['mobile'])->first();
        if (!$admin) {
            return redirect('admin-login')->with('error', " Admin not found!");
        }
        $otp = rand(1000, 9999);
        $latestOTP = MobileLogin::where('admin_id', $admin->id)->latest('id')->first();
        session(['latestOTP' => $latestOTP]);
        if (Session::has('latestOTP')) {
            $latestOTP->delete();
            return redirect('admin-login');
        }

        $currentDateTime = Carbon::now()->addMinutes(1);
        MobileLogin::create([
            'admin_id' => $admin->id,
            'otp' => $otp,
            'mobile' => $request->mobile,
            'expires_at' => $currentDateTime
        ]);

        $this->smsApiService->OTP($admin);
        $this->AdminEmailService->configureMailer($admin, $emailTemplate);
        // $this->TwilioSmsService->sendSms($admin); // Twilio Api
        return view('admin-forgot-password-form', [
            'admin' =>
            $admin,
            'success' => 'OTP has been sent successfully!'
        ]);
    }
    public function verifyOtpForgotPassword(Request $request)
    {

        $request->validate([
            'mobile' => 'required|digits:10',
            'otp' => 'required|digits:4',
        ]);
        $mobileLogin = MobileLogin::where('mobile', $request->mobile)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now())
            ->first();

        $admin = Admin::with(['otps' => function ($query) {
            $query->latest('id')->first();
        }])->first();
        if (!$mobileLogin) {
            return view('admin-forgot-password-form', [
                'admin' => $admin,
                'error' => 'Incorrect OTP or OTP expired'
            ]);
        }

        return view('change-password-form', compact('admin'))->with('success', 'Veified, Now you can set new  password!');
    }

    public function changePassword(Request $request)
    {

        try {
            // Validate the request data
            $validatedData = $request->validate([
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required_with:password|same:password',
                'mobile' => 'required|digits:10',
            ], [
                'password.required' => 'Please enter a password.',
                'password.confirmed' => 'The password confirmation does not match.',
                'password.min' => 'The password must be at least 8 characters long.',
                'mobile.required' => 'Please enter your mobile number.',
                'mobile.digits' => 'The mobile number must be exactly 10 digits.',
            ]);

            $admin = Admin::where('mobile', $validatedData['mobile'])->first();


            if (!$admin) {
                return redirect()->route('admin-login')->with('error', 'Admin not found. Please try again.');
            }


            $admin->update([
                'password' => Hash::make($validatedData['password'])
            ]);


            $latestOTP = MobileLogin::where('admin_id', $admin->id)->latest('id')->first();
            if ($latestOTP) {
                $latestOTP->delete();
            }


            session()->forget('latestOTP');


            Auth::guard('admin')->login($admin);


            return redirect('admin/dashboard')->with('success', 'Password changed successfully!');
        } catch (\Exception $e) {

            return redirect()->route('admin-login')->withErrors(['error' => 'An error occurred while changing the password. Please try again.']);
        }
    }
    public function showVerifyOtpForm(Request $request)
    {

        return view('change-password-form');
    }



















































    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {

    // }
    // public function index()

    // {
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }
}
