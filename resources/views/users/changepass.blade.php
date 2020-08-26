@extends('layouts.app')

@section('content')
<div class="container">
    <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        @if (Auth::guest())
        <div class="row text-center mt-5">
            <div class="col-sm-6">
                <li><a href="{{ route('login') }}" class="btn btn-lg font-weight-bolder">Login</a></li>
            </div>
        </div>
        @else
            {!! Form::open(['action' => 'UsersController@SaveNewPass', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group row">
                    <label for="password" style="color:black;">{{ __('New Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="form-group row">
                    <label for="password-confirm" style="color:black;">{{ __('Confirm New Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
                {{Form::submit('Update Password', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
        @endif
    </ul>
    
@endsection

