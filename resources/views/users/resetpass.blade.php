<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('APP_NAME', 'Converse') }}</title>

    <!--Link to Font Awesome Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- Custom CSS -->
    

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body style="background-image: url({{ asset('img/loginpage.jpg') }}); color:white;" >
    <div class='container text-center jerry' style="padding-top:150px;">

        <img class="mx-auto" style="border-radius: 10px;" src="{{asset('img/co.jpg')}}" alt="This is an image of logo">
        <div id="header">
            <h4 class="mt-2">Reset Password</h4>
        </div> 

        {!! Form::open(['action' => 'UsersController@ResetPass', 'method' => 'POST']) !!}
            <div class=form-group>
                {{Form::label('email', 'Enter Your Email')}}
                {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email'])}}
            </div>

            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}

        <div style="margin-top: 16px;">
            <a href="/login">
                <button class="btn btn-link text-light">Go Back</button>
            </a>
        </div>
        
    </div>
</body>
</html>