@extends('layouts.app')

@section('content')
<div class="px-2">
  <h4 class="font-weight-bold">All Messages</h4>
    @if(count($posts) > 0)
      <div class="row p-2">
        @foreach($posts as $post)
        <div class="col-sm-4 p-2">
        <div class="card text-light bg-dark">
            <div class="card-body">
              <h4 class="card-title">{{$post->title}}</h4>
              <h6 class="card-subtitle mb-2 text-muted"><small class="text-light">Written on {{$post->created_at}} by {{$post->user->name}}</small></h6>
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
        {{$posts->links()}}
    @else
        <p>No messages found</p>
    @endif
</div>
@endsection