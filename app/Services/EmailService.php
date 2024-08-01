<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class EmailService
{
    public function sendMail($guard, $data)
    {
        // Check the guard and set the appropriate mailer
        if ($guard === 'admin') {
            Config::set('mail.default', 'admin_smtp'); // Use the custom admin SMTP mailer
        } else {
            Config::set('mail.default', 'smtp'); // Use the default SMTP mailer
        }

        // Send the email
        Mail::send('emails.template', $data, function ($message) use ($data) {
            $message->to($data['email'])
                    ->subject($data['subject']);
        });
    }
}
