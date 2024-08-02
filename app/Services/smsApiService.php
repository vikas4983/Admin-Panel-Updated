<?php

namespace App\Services;

use App\Models\SmsApi;
use Illuminate\Support\Facades\Http;

class SmsApiService
{
    public function sendSms($findadmin)
    {
        if($findadmin){
            $name = $findadmin->name;
            $number = $findadmin->mobile;
            $otp = $findadmin->otps->last()->otp;
            $DateTIme = $findadmin->otps->last()->expires_at;
            dump($name, $number, $otp, $DateTIme);
        }else{
          return redirect()->back()->with('error', "Sometning went wrong, please try again!");
        }
        // Get the most recent settings
        $settings = SmsApi::where('template_id', 91722)->first();
        
        // Prepare the message with the OTP
        $messageTemplate = $settings->message; // Get template from DB

        //dd($messageTemplate);
        // $message = str_replace('{#var#}', $otp,  $messageTemplate); // Replace admin name
        $message = str_replace('{#var#}', $otp, $messageTemplate); // Replace admin name
       
       
        // URL-encode the message
        $encodedMessage = urlencode($message);

       // dd($message);

        // Construct the URL with encoded message
        $url = "https://www.bulksmsplans.com/api/send_sms?api_id={$settings->api_id}&api_password={$settings->api_password}&sms_type=Transactional&sms_encoding=text&sender={$settings->sender}&number={$number}&message={$message}&template_id={$settings->template_id}";

        dump($url);
        // Make the HTTP request
        $response = Http::get($url);

        // Handle the response as needed
        if ($response->successful()) {
            return $response->json(); // or process the response as required
        } else {
            // Handle error
            throw new \Exception('SMS sending failed: ' . $response->body());
        }
    }
}

