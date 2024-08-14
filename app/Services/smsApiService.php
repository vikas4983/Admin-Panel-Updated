<?php

namespace App\Services;

use App\Models\SmsApi;
use App\View\Components\LoginWithOtp;
use Illuminate\Support\Facades\Http;

class SmsApiService
{
    public function OTP($admin)
    {
        if ($admin) {
            $name = $admin->name;
            $number = $admin->mobile;
            $otp = $admin->otps->last()->otp;
            $DateTIme = $admin->otps->last()->expires_at;
        } else {
            return redirect()->back()->with('error', "Something went wrong, please try again!");
        }
       
        $settings = SmsApi::where('status', 1)->get();

        if (!$settings) {

            $settings = (object) [
                'api_id' => 'default_api_id',
                'api_password' => 'default_api_password',
                'sender' => 'default_sender',
                'message' => 'Your OTP is {#var#}',
                'template_id' => 'default_template_id',
            ];
        }
        $loginWithOtpSetting = SmsApi::where('status', 1)->where('name', 'Login-With-Otp')->first();
        $resendOTP = SmsApi::where('status', 1)->where('name', 'Resend-OTP')->first();
        $forgetOTP = SmsApi::where('status', 1)->where('name', 'Forget-OTP')->first();
        $AccountVerificationOTP = SmsApi::where('status', 1)->where('name', 'Account-verification')->first();

        foreach ($settings as $setting) {
            if ($loginWithOtpSetting->name == $setting->name) {
                if ($loginWithOtpSetting) {

                    $messageTemplate = $loginWithOtpSetting->message ?? 'Your OTP is {#var#}';
                    $message = str_replace('{#var#}', $otp, $messageTemplate);
                    $encodedMessage = urlencode($message);


                    $url = "https://www.bulksmsplans.com/api/send_sms?api_id={$loginWithOtpSetting->api_id}&api_password={$loginWithOtpSetting->api_password}&sms_type=Transactional&sms_encoding=text&sender={$loginWithOtpSetting->sender}&number={$number}&message={$encodedMessage}&template_id={$loginWithOtpSetting->template_id}";
                }
            }
            if ($resendOTP->name == $setting->name) {
                if ($resendOTP) {
                    $messageTemplate = $resendOTP->message ?? 'Your OTP is {#var#}';
                    $message = str_replace('{#var#}', $otp, $messageTemplate);

                    $encodedMessage = urlencode($message);


                    $url = "https://www.bulksmsplans.com/api/send_sms?api_id={$resendOTP->api_id}&api_password={$resendOTP->api_password}&sms_type=Transactional&sms_encoding=text&sender={$resendOTP->sender}&number={$number}&message={$encodedMessage}&template_id={$resendOTP->template_id}";
                }
            }
            if ($forgetOTP->name == $setting->name) {
                if ($forgetOTP) {

                    $messageTemplate = $forgetOTP->message ?? 'Your OTP is {#var#}';
                    $message = str_replace('{#var#}', $otp, $messageTemplate);

                    $encodedMessage = urlencode($message);


                    $url = "https://www.bulksmsplans.com/api/send_sms?api_id={$forgetOTP->api_id}&api_password={$forgetOTP->api_password}&sms_type=Transactional&sms_encoding=text&sender={$forgetOTP->sender}&number={$number}&message={$encodedMessage}&template_id={$forgetOTP->template_id}";
                }
            }
            if ($AccountVerificationOTP->name == $setting->name) {
                if ($AccountVerificationOTP) {

                    $messageTemplate = $AccountVerificationOTP->message ?? 'Your OTP is {#var#}';
                    $message = str_replace('{#var#}', $otp, $messageTemplate);

                    $encodedMessage = urlencode($message);


                    $url = "https://www.bulksmsplans.com/api/send_sms?api_id={$AccountVerificationOTP->api_id}&api_password={$AccountVerificationOTP->api_password}&sms_type=Transactional&sms_encoding=text&sender={$AccountVerificationOTP->sender}&number={$number}&message={$encodedMessage}&template_id={$AccountVerificationOTP->template_id}";
                }
            }
        }
        try {
            $response = Http::get($url);


            if ($response->successful()) {
                return $response->json(); // 
            } else {

                $errorMessage = 'SMS sending failed: ' . $response->body();
            }
        } catch (\Exception $e) {

            $errorMessage = 'Exception occurred: ' . $e->getMessage();
        }
        return [
            'success' => false,
            'message' => $errorMessage,
        ];
    }
}










































































//     public function resendOTP($admin)
//     {
//         if ($admin) {
//             $name = $admin->name;
//             $number = $admin->mobile;
//             $otp = $admin->otps->last()->otp;
//             $DateTIme = $admin->otps->last()->expires_at;
//             //dump($name, $number, $otp, $DateTIme);
//         } else {
//             return redirect()->back()->with('error', "Something went wrong, please try again!");
//         }

//         // Get the most recent settings
//         $settings = SmsApi::where('status', 1)->where('name', 'Resend-OTP')->first();

//         if (!$settings) {
//             // Handle the case where $settings is null by setting default values
//             $settings = (object) [
//                 'api_id' => 'default_api_id',
//                 'api_password' => 'default_api_password',
//                 'sender' => 'default_sender',
//                 'message' => 'Your OTP is {#var#}',
//                 'template_id' => 'default_template_id',
//             ];
//         }

//         // Prepare the message with the OTP
//         $messageTemplate = $settings->message ?? 'Your OTP is {#var#}'; // Default template if none found
//         $message = str_replace('{#var#}', $otp, $messageTemplate); // Replace OTP in the template
//         // URL-encode the message
//         $encodedMessage = urlencode($message);

//         // Construct the URL with encoded message
//         $url = "https://www.bulksmsplans.com/api/send_sms?api_id={$settings->api_id}&api_password={$settings->api_password}&sms_type=Transactional&sms_encoding=text&sender={$settings->sender}&number={$number}&message={$encodedMessage}&template_id={$settings->template_id}";

//         // Try to send the SMS
//         try {
//             $response = Http::get($url);

//             // Check if the SMS was sent successfully
//             if ($response->successful()) {
//                 return $response->json(); // Process the successful response
//             } else {
//                 // Handle error but continue execution
//                 $errorMessage = 'SMS sending failed: ' . $response->body();
//                 // Log or handle the error as needed
//             }
//         } catch (\Exception $e) {
//             // Catch any exceptions and continue execution
//             $errorMessage = 'Exception occurred: ' . $e->getMessage();
//             // Log or handle the error as needed
//         }

//         // Code continues to run ahead, even if SMS sending failed
//         // You can return a response, log information, or continue with other logic
//         // Example: log the error and continue
//         // Log::error($errorMessage);
//         // Continue with other logic
//         return [
//             'success' => false,
//             'message' => $errorMessage,
//         ];
//     }
//     public function forgetOTP($admin)
//     {
//         if ($admin) {
//             $name = $admin->name;
//             $number = $admin->mobile;
//             $otp = $admin->otps->last()->otp;
//             $DateTIme = $admin->otps->last()->expires_at;
//             //dump($name, $number, $otp, $DateTIme);
//         } else {
//             return redirect()->back()->with('error', "Something went wrong, please try again!");
//         }

//         // Get the most recent settings
//         $settings = SmsApi::where('status', 1)->where('name', 'Account-verification')->first();
        
//         if (!$settings) {
//             // Handle the case where $settings is null by setting default values
//             $settings = (object) [
//                 'api_id' => 'default_api_id',
//                 'api_password' => 'default_api_password',
//                 'sender' => 'default_sender',
//                 'message' => 'Your OTP is {#var#}',
//                 'template_id' => 'default_template_id',
//             ];
//         }

//         // Prepare the message with the OTP
//         $messageTemplate = $settings->message ?? 'Your OTP is {#var#}'; // Default template if none found
//         $message = str_replace('{#var#}', $otp, $messageTemplate); // Replace OTP in the template
//         // URL-encode the message
//         $encodedMessage = urlencode($message);

//         // Construct the URL with encoded message
//         $url = "https://www.bulksmsplans.com/api/send_sms?api_id={$settings->api_id}&api_password={$settings->api_password}&sms_type=Transactional&sms_encoding=text&sender={$settings->sender}&number={$number}&message={$encodedMessage}&template_id={$settings->template_id}";

//         // Try to send the SMS
//         try {
//             $response = Http::get($url);

//             // Check if the SMS was sent successfully
//             if ($response->successful()) {
//                 return $response->json(); // Process the successful response
//             } else {
//                 // Handle error but continue execution
//                 $errorMessage = 'SMS sending failed: ' . $response->body();
//                 // Log or handle the error as needed
//             }
//         } catch (\Exception $e) {
//             // Catch any exceptions and continue execution
//             $errorMessage = 'Exception occurred: ' . $e->getMessage();
//             // Log or handle the error as needed
//         }

//         // Code continues to run ahead, even if SMS sending failed
//         // You can return a response, log information, or continue with other logic
//         // Example: log the error and continue
//         // Log::error($errorMessage);
//         // Continue with other logic
//         return [
//             'success' => false,
//             'message' => $errorMessage,
//         ];
//     }

//     public function AccountVerification($admin)
//     {
//         if ($admin) {
//             $name = $admin->name;
//             $number = $admin->mobile;
//             $otp = $admin->otps->last()->otp;
//             $DateTIme = $admin->otps->last()->expires_at;
//             //dump($name, $number, $otp, $DateTIme);
//         } else {
//             return redirect()->back()->with('error', "Something went wrong, please try again!");
//         }

//         // Get the most recent settings
//         $settings = SmsApi::where('status', 1)->where('name', 'Account-verification')->first();

//         if (!$settings) {
//             // Handle the case where $settings is null by setting default values
//             $settings = (object) [
//                 'api_id' => 'default_api_id',
//                 'api_password' => 'default_api_password',
//                 'sender' => 'default_sender',
//                 'message' => 'Your OTP is {#var#}',
//                 'template_id' => 'default_template_id',
//             ];
//         }

//         // Prepare the message with the OTP
//         $messageTemplate = $settings->message ?? 'Your OTP is {#var#}'; // Default template if none found
//         $message = str_replace('{#var#}', $otp, $messageTemplate); // Replace OTP in the template
//         // URL-encode the message
//         $encodedMessage = urlencode($message);

//         // Construct the URL with encoded message
//         $url = "https://www.bulksmsplans.com/api/send_sms?api_id={$settings->api_id}&api_password={$settings->api_password}&sms_type=Transactional&sms_encoding=text&sender={$settings->sender}&number={$number}&message={$encodedMessage}&template_id={$settings->template_id}";

//         // Try to send the SMS
//         try {
//             $response = Http::get($url);

//             // Check if the SMS was sent successfully
//             if ($response->successful()) {
//                 return $response->json(); // Process the successful response
//             } else {
//                 // Handle error but continue execution
//                 $errorMessage = 'SMS sending failed: ' . $response->body();
//                 // Log or handle the error as needed
//             }
//         } catch (\Exception $e) {
//             // Catch any exceptions and continue execution
//             $errorMessage = 'Exception occurred: ' . $e->getMessage();
//             // Log or handle the error as needed
//         }

//         // Code continues to run ahead, even if SMS sending failed
//         // You can return a response, log information, or continue with other logic
//         // Example: log the error and continue
//         // Log::error($errorMessage);
//         // Continue with other logic
//         return [
//             'success' => false,
//             'message' => $errorMessage,
//         ];
//     }





































































//     $loginWithOtpSetting = SmsApi::where('status', 1)->where('name', 'LoginWithOtp')->first();
    //     
    //    dd($loginWithOtpSetting);
        
        
        // if ($resendOTP) {
        //     // Prepare the message with the OTP
        //     $messageTemplate = $resendOTP->message ?? 'Your OTP is {#var#}'; // Default template if none found
        //     $message = str_replace('{#var#}', $otp, $messageTemplate); // Replace OTP in the template
        //     // URL-encode the message
        //     $encodedMessage = urlencode($message);

        //     // Construct the URL with encoded message
        //     $url = "https://www.bulksmsplans.com/api/send_sms?api_id={$resendOTP->api_id}&api_password={$resendOTP->api_password}&sms_type=Transactional&sms_encoding=text&sender={$resendOTP->sender}&number={$number}&message={$encodedMessage}&template_id={$resendOTP->template_id}";
        // }
        // if ($forgetOTP) {
        //     // Prepare the message with the OTP
        //     $messageTemplate = $forgetOTP->message ?? 'Your OTP is {#var#}'; // Default template if none found
        //     $message = str_replace('{#var#}', $otp, $messageTemplate); // Replace OTP in the template
        //     // URL-encode the message
        //     $encodedMessage = urlencode($message);

        //     // Construct the URL with encoded message
        //     $url = "https://www.bulksmsplans.com/api/send_sms?api_id={$forgetOTP->api_id}&api_password={$forgetOTP->api_password}&sms_type=Transactional&sms_encoding=text&sender={$forgetOTP->sender}&number={$number}&message={$encodedMessage}&template_id={$forgetOTP->template_id}";
        // }
        // if ($AccountVerificationOTP) {
        //     // Prepare the message with the OTP
        //     $messageTemplate = $AccountVerificationOTP->message ?? 'Your OTP is {#var#}'; // Default template if none found
        //     $message = str_replace('{#var#}', $otp, $messageTemplate); // Replace OTP in the template
        //     // URL-encode the message
        //     $encodedMessage = urlencode($message);

        //     // Construct the URL with encoded message
        //     $url = "https://www.bulksmsplans.com/api/send_sms?api_id={$AccountVerificationOTP->api_id}&api_password={$AccountVerificationOTP->api_password}&sms_type=Transactional&sms_encoding=text&sender={$AccountVerificationOTP->sender}&number={$number}&message={$encodedMessage}&template_id={$AccountVerificationOTP->template_id}";
        // }
