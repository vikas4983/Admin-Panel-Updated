<?php

namespace App\Mail;

use App\Models\Menu;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegisteredAdmin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

     public $admin;
    
    public $emailTemplate;
    public function __construct($admin,$emailTemplate )
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
    //         subject: 'Registered Admin',
    //     );
    // }

    /**
     * Get the message content definition.
     */

     public function build()
     {
        
  // Add footers with URLs to the body
  $footers = Menu::where('status', 1)->where('section', 0)->get();
  $footerContent = '<ul>';
  foreach ($footers as $footer) {
      $footerContent .= '<li><a href="' . $footer->url . '">' . $footer->name . '</a></li>';
  }
  $footerContent .= '</ul>';

  // Append the footer content to the email body
  
         // Replace placeholders in the subject and body with actual values
         $subject = str_replace(
             ['{{ name }}'], 
             [$this->admin->name], 
             $this->emailTemplate->subject
         );
 
         $body = str_replace(
             ['{{ name }}'], 
             [$this->admin->name], 
             $this->emailTemplate->body
         );
         $body .= $footerContent;
         $renderedBody = \Blade::render($body, ['admin' => $this->admin, 'footers'=> $footers]);
         return $this->subject($subject)
                     ->html($renderedBody);
     }




    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
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
