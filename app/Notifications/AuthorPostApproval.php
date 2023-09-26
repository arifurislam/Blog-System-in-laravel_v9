<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AuthorPostApproval extends Notification
{
    use Queueable;

    public $post;

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->subject('Your post has been approved')
                ->greeting('Hello, '.$this->post->user->name. ' !')
                ->line('your post has been approved')
                ->line('Post Title : '.$this->post->title)
                ->action('View', url('author/posts/'.$this->post->id))
                ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
