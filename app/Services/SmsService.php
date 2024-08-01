<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
protected $apiUrl;
protected $apiId;
protected $apiPassword;

public function __construct()
{
$this->apiUrl = 'https://www.bulksmsplans.com/api/send_sms';
$this->apiId = env('SMS_API_ID');
$this->apiPassword = env('SMS_API_PASSWORD');
}

public function sendSms($mobile, $message)
{
// Validate parameters
if (empty($mobile) || empty($message)) {
throw new \InvalidArgumentException('Mobile number and message are required.');
}

// Log the parameters being sent
Log::info('Sending SMS', [
'api_url' => $this->apiUrl,
'api_id' => $this->apiId,
'api_password' => $this->apiPassword,
'mobile' => $mobile,
'message' => $message,
]);



// Make the POST request with retry logic
$response = Http::retry(3, 100)->get($this->apiUrl, [
'api_id' => $this->apiId,
'api_password' => $this->apiPassword,
'sms_type' => 'Transactional',
'sms_encoding' => 'text',
'sender' => 'MMMTRI',
'number' => $mobile,
'message' => $message,
'template_id' => '91722', // Replace with your template ID
]);

// Log the response for debugging
Log::info('SMS API Response', [
'status' => $response->status(),
'response' => $response->json()
]);
        
if ($response->failed()) {
$error = $response->json();
Log::error('SMS API Error', $error);
throw new \Exception('SMS API Error: ' . $error['message']);
}

return $response->json();
}
}