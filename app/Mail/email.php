<?php



namespace App\Mail;

use App\Models\EmailSetting;
use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class email extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;
    //public $type;
    public $emailTemplate;

    /**
     * Create a new message instance.
     */
    public function __construct($admin, $emailTemplate)
    {
        $this->admin = $admin;
        $this->emailTemplate = $emailTemplate;
      
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Email',
    //     );
    // }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        $otp = $this->admin->otps->first()->otp;

        // Replace placeholders in the subject and body with actual values
        $subject = str_replace(
            ['{{ name }}', '{{ otp }}'], 
            [$this->admin->name, $otp], 
            $this->emailTemplate->subject
        );

        $body = str_replace(
            ['{{ name }}', '{{ otp }}'], 
            [$this->admin->name, $otp], 
            $this->emailTemplate->body
        );

        $renderedBody = \Blade::render($body, ['admin' => $this->admin, 'otp' => $otp]);
        return $this->subject($subject)
                    ->html($renderedBody);
    }
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
