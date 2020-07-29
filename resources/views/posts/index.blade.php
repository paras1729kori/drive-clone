@extends('layouts.app')

@section('content')
<div class="px-2">
  <h4 class="font-weight-bold">All Messages</h4>
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
        {{$posts->links()}}
    @else
        <p class="pt-1">No messages found</p>
    @endif
</div>
@endsection