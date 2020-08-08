@extends('layouts.app')

@section('content')
<div class="px-2">

    {{-- For General Messages --}}
    <h4 class="font-weight-bold">All Messages</h4>
    @if(count($posts) > 0)
      <div class="row px-2">
        @foreach($posts as $post)
          <div class="col-sm-3 px-2">
            <div class="card text-light bg-dark">
              <div class="card-body">
                <h4><a href="/posts/{{$post->id}}">{{$post->title}}</a></h4>
                <h6>Written on {{$post->created_at}} by {{$post->user->name}}</h6>
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
      @endif
      <br>
      {{-- For Private Messages --}}
      <h4 class="font-weight-bold">Private Messages</h4>
      @if(count($per_posts) > 0)
      <div class="row px-2">
        @foreach($per_posts as $post)
          <div class="col-sm-3 px-2">
            <div class="card text-light bg-dark">
              <div class="card-body">
                <h4><a href="/posts/{{$post->id}}">{{$post->title}}</a></h4>
                <h6>Written on {{$post->created_at}} by {{$post->user->name}}</h6>
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
      <a href="/posts/create" class="btn btn-primary mt-2">Messages</a>
    @else
        <p class="pt-1">No messages found</p>
    @endif
</div>
@endsection