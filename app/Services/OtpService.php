<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use App\Services\SmsService;

class OtpService
{
    protected $SmsService;

    public function __construct(SmsService $smsService)
    {
        $this->SmsService = $smsService;
    }

    public function generateOtp($mobile)
    {
       
        $otp = rand(100000, 999999); // Generate a 6-digit OTP
        Cache::put('otp_' . $mobile, $otp, now()->addMinutes(5)); // Cache OTP for 5 minutes
        return $otp;
    }

    public function sendOtp($mobile)
    {
          
        $otp = $this->generateOtp($mobile);
        
        $message = 'Your OTP is: ' . $otp;
        
        $this->SmsService->sendSms($mobile, $message);
    }

    public function verifyOtp($mobile, $otp)
    {
        return Cache::get('otp_' . $mobile) == $otp;
    }
}
