<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- return (new MailMessage)
    ->subject('New post Available')
    ->greeting('Hello, Subscriber')
    ->line('You have a new post, if you want can chack it out')
    ->line('Post Title : ' .$this->post->title )
    ->action('View', url('/'))
    ->line('Thank you !'); --}}

    <h4>Hello, Subscriber</h4>
    <p>You have a new post, if you want can chack it out</p>
    <a href="{{url('/')}}">Post Title: {{$this->post->title}}</a>
    <p>thank you</p>
</body>
</html>