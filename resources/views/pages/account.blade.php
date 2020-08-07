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
            <li class="dropdown mb-3">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu text-center" role="menu">
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
        @endif
    </ul>
    <h4 class="font-weight-bold">Your Messages</h4>
    <a href="/posts/create" class="btn btn-primary">Create Messages</a>
    @if(count($posts) > 0)
      <div class="row p-2">
        @foreach($posts as $post)
        <div class="col-sm-4 p-2">
        <div class="card text-light bg-dark">
            <div class="card-body">
                <h4 class="card-title d-inline">{{$post->title}} <h5 class="d-inline">by {{$post->user->name}}</h5></h4>
              <h6 class="card-subtitle mb-1 text-muted"><small class="text-light">Written on {{$post->created_at}}</small></h6>
              <p class="card-text">
                {{$post->body}}
              </p>
              @if(!Auth::guest())
                @if(Auth::user()->id == $post->user_id)
                    <a href="/posts/{{$post->id}}/edit" class="btn btn-success btn-default">Edit</a>

                    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'DELETE', 'class' => 'pull-right'])!!}
                        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                    {!!Form::close()!!}
                @endif
            @endif
            </div>
          </div>
        </div> 
        @endforeach
      </div>
    @else
        <p>No messages found</p>
    @endif
</div>
@endsection

