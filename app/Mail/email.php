<?php



namespace App\Mail;

use App\Models\EmailSetting;
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
    public $type;

    /**
     * Create a new message instance.
     */
    public function __construct($admin, $type)
    {
        //dump($admin, $type);
        $emailSetting = EmailSetting::where('status', 1)->first();
       
        $this->admin = $admin;
        $this->type = $type; // Correctly assigning $type
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
{
    return $this->subject('Admin')
        ->view('emails.email')
        ->with([
            'admin' => $this->admin,
            'type' => $this->type,
        ]);
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