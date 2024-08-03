<?php

namespace App\Services;

use libphonenumber\PhoneNumberUtil;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\NumberParseException; // Import the exception class

class PhoneNumberService
{
    public function formatPhoneNumber($number)
    {
        // Remove any non-numeric characters
        $number = preg_replace('/\D/', '', $number);

        // Ensure the number starts with the country code (e.g., +91 for India).s
        if (substr($number, 0, 2) !== '91') {
            $number = '91' . $number;
        }
        //abc

        // Return in E.164 format
        //  return '+' . $number;
        return  $number;
    }
}
