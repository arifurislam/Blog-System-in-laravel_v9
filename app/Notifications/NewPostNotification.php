<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPostNotification extends Notification
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
                    ->subject('New post Available')
                    ->greeting('Hello, Subscriber')
                    ->line('You have a new post, if you want can chack it out')
                    ->line('Post Title : ' .$this->post->title )
                    ->action('View', url('/'))
                    ->line('Thank you !');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
