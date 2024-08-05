<?php

namespace App\Http\Controllers\admin_auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\MobileLogin;
use App\Services\PhoneNumberService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\smsApiService;
use App\Services\TwilioSmsService;
use Illuminate\Support\Facades\Session;

class MobileLoginController extends Controller
{
    protected $smsApiService;
    protected $phoneNumberService;
    protected $TwilioSmsService;
    public function __construct(smsApiService $smsApiService, phoneNumberService $phoneNumberService, TwilioSmsService $TwilioSmsService)
    {
        $this->smsApiService = $smsApiService;
        $this->phoneNumberService = $phoneNumberService;
        $this->TwilioSmsService = $TwilioSmsService;
    }


    public function mobilelogin()
    {
        session()->has('otp_sent');
        session()->forget('otp_sent');
        return view('admin-login')->with('error', "Something went wrong please try again latter");
    }

    public function sendOtp(Request $request)
    {

        $validateRequest = $request->validate([
            'mobile' => ['required', 'digits:10'],
        ]);
        $number = $validateRequest['mobile'];
        $findadmin = Admin::where('mobile', $number)->first();
        if (!$findadmin) {
            return back()->with('error', "Admin not found!");
        }
        $otp = rand(1000, 9999);
        $latestOTP = MobileLogin::where('admin_id', $findadmin->id)->latest('id')->first();
        $currentDateTime = Carbon::now();
        if ($latestOTP) {
            $createdOTPTime = $latestOTP->expires_at;

            if ($createdOTPTime > $currentDateTime) {
                session()->put('otp_sent', true);
                return redirect('admin-login')->with('error', "Please login agin!"); // Redirect to login page
            }
        }
        try {
            $currentDateTime = Carbon::now()->addMinutes(1);
            MobileLogin::create([
                'admin_id' => $findadmin->id,
                'otp' => $otp,
                'mobile' => $request->mobile,
                'expires_at' => $currentDateTime
            ]);
            // $admin = Admin::with(['otps' => function ($query) {
            //     $query->latest('id')->first();
            // }])->first();
            $this->smsApiService->sendSms($findadmin); // BulkSmsPlansApi
            $this->TwilioSmsService->sendSms($findadmin); // Twilio Api

            return view('verify_otp', [
                'admin' =>
                $findadmin,
                'success' => 'OTP has been sent successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
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
                'error' => 'Invalid OTP or OTP expired'
            ]);
        }

        $admin = Admin::where('mobile', $request->mobile)->first();
        Auth::guard('admin')->login($admin);
        // Clear OTP sent session variable
        session()->forget('otp_sent');
        return redirect('admin/dashboard')->with('success', 'Logged in successfully');
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
