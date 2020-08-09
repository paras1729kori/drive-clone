@extends('layouts.app')

@section('content')
<div class="px-2">
  <div class="row">
    <div class="col-10">
      {{-- For General Messages --}}
    <h4 class="font-weight-bold">General Messages</h4>
    @if(count($posts) > 0)
      <div class="row px-2">
        @foreach($posts as $post)
          <div class="col-sm-3 px-2">
            <div class="card text-light" style="background-color: rgb(71, 32, 71)">
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
      <h4 class="font-weight-bold">Recieved Private Messages</h4>
      @if(count($per_posts) > 0)
      <div class="row px-2">
        @foreach($per_posts as $post)
          <div class="col-sm-3 px-2">
            @php
                if($post->reciever = auth()->user()->id){
                  $color = '#82262a';
                }
                elseif($post->user_id = auth()->user()->id){
                  $color = '#252e22';
                }
            @endphp
            <div class="card text-light" style="background-color:{{$color}}">
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
    @else
        <p class="pt-1">No messages found</p>
    @endif
    </div>
    <div class="col-2">
      {!! Form::open() !!}
        <div class="form-group">
          {{Form::label('filter_by_id', 'Filter by Name')}}
          <select class="form-control opt" name="filter_name" id="filter_name">
              <option value="nullable">Select Folder</option>
              @foreach ($users as $user)
                <option value="{{$user->id}}">{{ $user->name }}</option>
              @endforeach
            </select>
        </div>
        <a href="/posts/filter" class="btn btn-primary float-right">Submit</a>
      {!! Form::close() !!}
    </div>
  </div>
  <a href="/posts/create" class="btn btn-primary mt-5">Messages</a>
</div>
@endsection