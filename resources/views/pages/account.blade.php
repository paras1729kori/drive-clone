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

                        <form id="logout-form" action="/session/logout" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    <hr>
                    <li>
                    <a class="btn btn-link" href="/changepassword/user">Reset Password</a>
                    </li>
                </ul>
            </li>
        @endif
    </ul>
    <h4 class="font-weight-bold">Sent Messages</h4>
    @if(count($posts) > 0)
      <div class="row p-2">
        @foreach($posts as $post)
        @if($post->general == '0')
            <div class="col-sm-2 px-1 py-1">
                @php
                if($post->reciever == auth()->user()->id){
                  $color = '#82262a';
                }
                elseif($post->user_id == auth()->user()->id){
                  $color = '#212529';
                }
            @endphp
            <div class="card text-light" style="background-color:{{$color}}">
                <div class="card-body">
                    <h4>{{$post->title}}</h4>
                    <h6>From: {{$post->user->name}}</h6>
                    <h6>To: {{$user_names[$post->reciever]}}</h6>
                    <small>Written on {{$post->created_at}}</small>
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
        @else
        <div class="col-sm-2 px-1 py-1">
            <div class="card text-light" style="background-color: rgb(71, 32, 71)">
                <div class="card-body">
                    <h4>{{$post->title}}</h4>
                    <h6>{{$post->user->name}}</h6>
                    <small>Written on {{$post->created_at}}</small>
                <p class="card-text font-italic">
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
            @endif
        @endforeach
      </div>
    @else
        <p>No messages found</p>
    @endif
    <a href="/posts/create" class="btn btn-primary mb-2">Messages</a>
</div>
@endsection

