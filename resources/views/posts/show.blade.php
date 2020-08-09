@extends('layouts.app')

@section('content')
    <div class="p-2">
        <h4 class="font-weight-bold">Filtered Messages</h4>
        @if(count($posts) > 0)
        <div class="row px-2">
            @foreach($posts as $post)
            <div class="col-sm-3 px-2">
                <div class="card text-light" style="background-color: rgb(71, 32, 71)">
                <div class="card-body">
                    <h4>{{$post->title}}</h4>
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
        @else
            <p>No Messages Found</p>
        @endif
    </div>
@endsection