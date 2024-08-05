<?php


namespace App\Services;

use App\Models\TwilioCredential;
use App\Models\TwilioSms;
use Carbon\Carbon;
use Twilio\Rest\Client;

class TwilioSmsService
{
    protected $client;
    protected $from;
    protected $message;

    public function __construct()
    {
        $credentials = TwilioSms::where('status', 1)->first();
       
        if(!$credentials){
            $credentials = (object) [
                'client' => 'default_message',
                'from' => 'default_from',
                'message' => 'default_message',
               
            ];
        }
        
        else{
            $this->client = new Client($credentials->sid, $credentials->token);
            $this->from = $credentials->from_number;
            $this->message = $credentials->message;
            //dd($this->client, $this->from, $this->message );
          }
    }

    public function sendSms($admin)
    {
        // Extract and format the phone number
       // dump($findadmin);
        $rawMobile = preg_replace('/[^0-9]/', '', $admin->mobile); // Remove non-numeric characters
        $countryCode = '+91'; // Set the correct country code
        $formattedMobile = $countryCode . $rawMobile; // Append country code to the number
       // dump($formattedMobile);

        // Check if the number has the correct length for validation (10 digits for India)
        if (strlen($rawMobile) !== 10) {
            throw new \Exception("Invalid phone number length. Please ensure the number has 10 digits.");
        }

        $name = $admin->name;
        $SmsDeatils = $admin->otps()->latest('id')->first();
        $otp = $SmsDeatils->otp;
        //dd($otp);

        $expiresAtString = trim($SmsDeatils->expires_at);
        $otpExpired = Carbon::createFromFormat('Y-m-d H:i:s', $expiresAtString);
        $formattedDate = $otpExpired->format('d-M-Y H:i:s');
        //dd($formattedDate); // For debugging
        $message = str_replace(['{name}', '{otp}', '{formattedDate}'], [$name, $otp, $formattedDate], $this->message);
       
       try{
            if ($this->client) {
                return $this->client->messages->create($formattedMobile, [
                    'from' => $this->from,
                    'body' => $message,
                ]);
            }

            throw new \Exception("Unable to send SMS.");
        }
       
       catch(\Exception $e){
    $errorMessage = 'Exception occurred: ' . $e->getMessage();
        
       }
        return [
            'success' => false,
            'message' => $errorMessage,
        ];
       
    }
}
