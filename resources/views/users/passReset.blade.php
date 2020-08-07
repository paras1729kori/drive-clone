@extends('layouts.app')

@section('content')

<div class='container' style="background-color: #fff; border-radius: 20px; padding: 16px;">

    <div id="header">
        <span>Password Reset</span>
    </div>    

    {!! Form::open(['action' => 'AuthController@ChangePass', 'method' => 'POST']) !!}
        <div class=form-group>
            {{Form::label('password', 'New Password*')}}
            {{Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password'])}}
        </div>

        <div class=form-group>
            {{Form::label('password_confirmation', 'Confirm New Password*')}}
            {{Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password'])}}
        </div>

        {{Form::hidden('user', $user->id)}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
    
</div>
@endsection