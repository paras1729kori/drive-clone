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
            <div class="col-sm-6">
                <li><a href="{{ route('register') }}" class="btn btn-lg font-weight-bolder">Register</a></li>
            </div>
        </div>
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu text-center" role="menu">
                    <li><a href="/home">Home</a></li><hr>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    <hr>
                    <li>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </li>
                </ul>
            </li>
            <div class="row justify-content-center mt-5">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Info') }}</div>
        
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
        
                            {{ __('You are logged in!') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </ul>
</div>
@endsection

