<?php

namespace App\Services;

use App\Models\SmsApi;
use Illuminate\Support\Facades\Http;

class SmsApiService
{
    public function sendSms($admin)
    {
        if ($admin) {
            $name = $admin->name;
            $number = $admin->mobile;
            $otp = $admin->otps->last()->otp;
            $DateTIme = $admin->otps->last()->expires_at;
            //dump($name, $number, $otp, $DateTIme);
        } else {
            return redirect()->back()->with('error', "Something went wrong, please try again!");
        }

        // Get the most recent settings
        $settings = SmsApi::where('status', 1)->where('name', 'BulkPlans-Login')->first();

        if (!$settings) {
            // Handle the case where $settings is null by setting default values
            $settings = (object) [
                'api_id' => 'default_api_id',
                'api_password' => 'default_api_password',
                'sender' => 'default_sender',
                'message' => 'Your OTP is {#var#}',
                'template_id' => 'default_template_id',
            ];
        }

        // Prepare the message with the OTP
        $messageTemplate = $settings->message ?? 'Your OTP is {#var#}'; // Default template if none found
        $message = str_replace('{#var#}', $otp, $messageTemplate); // Replace OTP in the template
        // URL-encode the message
        $encodedMessage = urlencode($message);

        // Construct the URL with encoded message
        $url = "https://www.bulksmsplans.com/api/send_sms?api_id={$settings->api_id}&api_password={$settings->api_password}&sms_type=Transactional&sms_encoding=text&sender={$settings->sender}&number={$number}&message={$encodedMessage}&template_id={$settings->template_id}";

        // Try to send the SMS
        try {
            $response = Http::get($url);

            // Check if the SMS was sent successfully
            if ($response->successful()) {
                return $response->json(); // Process the successful response
            } else {
                // Handle error but continue execution
                $errorMessage = 'SMS sending failed: ' . $response->body();
                // Log or handle the error as needed
            }
        } catch (\Exception $e) {
            // Catch any exceptions and continue execution
            $errorMessage = 'Exception occurred: ' . $e->getMessage();
            // Log or handle the error as needed
        }

        // Code continues to run ahead, even if SMS sending failed
        // You can return a response, log information, or continue with other logic
        // Example: log the error and continue
        // Log::error($errorMessage);
        // Continue with other logic
        return [
            'success' => false,
            'message' => $errorMessage,
        ];
    }
}
