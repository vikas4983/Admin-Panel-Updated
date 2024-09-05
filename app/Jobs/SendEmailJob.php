<?php

namespace App\Jobs;

use App\Mail\Email; // Ensure this points to the correct mailable class
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $admin;
    protected $emailTemplate;

    // Constructor receives $admin and $emailTemplate when dispatched
    public function __construct($admin, $emailTemplate)
    {
        $this->admin = $admin;
        $this->emailTemplate = $emailTemplate;
    }

    // Execute the job
    public function handle(): void
    {
        
        if ($this->admin && $this->emailTemplate) {
            Mail::to($this->admin->email)->send(new Email($this->admin, $this->emailTemplate));
        }
    }
}
