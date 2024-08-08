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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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
    public function showform()
    {
        return view('verify_otp');
    }

    public function sendOtp(Request $request)
    {
        $validateRequest = $request->validate([
            'mobile' => ['required', 'digits:10'],
        ]);
        $number = $validateRequest['mobile'];
        $admin = Admin::where('mobile', $number)->first();

        if (!$admin) {
            // dd('Vikas');
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
            // $admin = Admin::with(['otps' => function ($query) {
            //     $query->latest('id')->first();
            // }])->first();
            $this->smsApiService->sendSms($admin); // BulkSmsPlansApi
            $this->TwilioSmsService->sendSms($admin); // Twilio Api

            return view('verify_otp', [
                'admin' =>
                $admin,
                'success' => 'OTP has been sent successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function resendOtp(Request $request)
    {
        $validateRequest = $request->validate([
            'mobile' => ['required', 'digits:10'],
        ]);
        $mobile = $validateRequest['mobile'];
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
            $this->smsApiService->sendSms($admin); // Using BulkSmsPlans API
            $this->TwilioSmsService->sendSms($admin); // Using Twilio API
            return response()->json(['success' => true, 'message' => 'Resend OTP sent successfully!']);
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

    // public function forgotpassword(Request $request)
    // { 
       
    //     $validatedata = $request->validate([
    //         'mobile' => ['required', 'max:10']
    //     ]);
    //     $admin = Admin::where('mobile', $validatedata['mobile'])->first();
    //     if (!$admin) {
    //         return redirect('admin-login')->with('error', " Admin not found!");
    //     }
    //     $otp = rand(1000, 9999);
    //     $latestOTP = MobileLogin::where('admin_id', $admin->id)->latest('id')->first();
    //     session(['latestOTP' => $latestOTP]);
    //     if (Session::has('latestOTP')) {
    //         $latestOTP->delete();
    //         return redirect('admin-login');
    //     }
       
    //         $currentDateTime = Carbon::now()->addMinutes(1);
    //         MobileLogin::create([
    //             'admin_id' => $admin->id,
    //             'otp' => $otp,
    //             'mobile' => $request->mobile,
    //             'expires_at' => $currentDateTime
    //         ]);
    //         $this->smsApiService->sendSms($admin); // BulkSmsPlansApi
    //         $this->TwilioSmsService->sendSms($admin); // Twilio Api
           
    //         $validateRequest = MobileLogin::where('mobile', $request->mobile)
    //             ->where('otp', $otp)
    //             ->where('expires_at', '>', now())
    //             ->first();
      
    //         if (!$validateRequest) {
    //             $admin = Admin::with(['otps' => function ($query) {
    //                 $query->latest('id')->first();
    //             }])->first();
    //             return view('verify_otp', [
    //                 'admin' => $admin,
    //                 'error' => 'Incorrect OTP or OTP expired'
    //             ]);
    //         }
            
    //         //session()->forget('latestOTP');
    //         return redirect('admin-forgot-password');
           
    // }

    //     public function updatepasswordform(Request $request)
    //  {
    //    return view('admin-forgot-password-form')->with('success', 'Verified, now you can change password!');
    //  }
    //     public function updatepassword(Request $request)
    //  {
    //     dd($request->dd());

    //  }


     




















































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
