<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>approval needed</title>
</head>

<body>

    <div style="text-align: center">
        <h2>Hello Admin !!!</h2>
        <h5>{{'New post by ' .$post->user->name .' need to approve'}}</h5>
        <p>To approve the post click view button</p>
        <p>{{'Post Title: ' .$post->title}}</p>
        <a class="btn btn-sm btn-primary" href="{{url('/')}}">view</a>
        <p>Thank you for using our application!</p>
    </div>
</body>

</html>
