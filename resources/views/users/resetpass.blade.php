@extends('layouts.app')

@section('content')

<div class='container' style="background-color: #fff; border-radius: 20px; padding: 16px;">

    <div id="header">
        <span>Password Reset</span>
    </div> 

    {!! Form::open(['action' => 'UsersController@ResetPass', 'method' => 'POST']) !!}
        <div class=form-group>
            {{Form::label('email', 'Enter Your Email')}}
            {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email'])}}
        </div>

        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

    <div style="margin-top: 16px;">
        <a href="/sdl/login">
            <button class="btn btn-link">Go Back</button>
        </a>
    </div>
    
</div>
@endsection