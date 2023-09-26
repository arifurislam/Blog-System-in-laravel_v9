<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewAuthorPost extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $post ;
    
    public function __construct($post)
    {
        $this->post = $post;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'New Pending Post !!! Need To Approve The Post ',
        );
    }

    public function content()
    {
        return new Content(
            view: 'email.approve_request',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
