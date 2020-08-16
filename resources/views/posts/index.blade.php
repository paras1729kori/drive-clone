@extends('layouts.app')

@section('content')
<div class="px-2">
  <div class="row" id="table_pc">
    <div class="col-10">
      {{-- For General Messages --}}
    <h4 class="font-weight-bold">General Messages</h4>
    @if(count($posts) > 0)
      <div class="row px-2">
        @foreach($posts as $post)
          <div class="col-sm-2 px-2">
            <div class="card text-light" style="background-color: rgb(71, 32, 71)">
              <div class="card-body">
                <h4>{{$post->title}}</h4>
                <h6>Written on {{$post->created_at}} by {{$post->user->name}}</h6>
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
        @endforeach
      </div>
      @endif
      <br>
      {{-- For Private Messages --}}
      <h4 class="font-weight-bold">Private Messages</h4>
      @if(count($per_posts) > 0)
      <div class="row px-2">
        @foreach($per_posts as $post)
          <div class="col-sm-2 px-2">
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
        @endforeach
      </div>
    @else
        <p class="pt-1">No messages found</p>
    @endif
    </div>
    @if (Auth::guest() || auth()->user()->usertype == 'admin')
    <div class="col-2">
      {!! Form::open(['action' => 'PostsController@filter', 'method' => 'GET']) !!}
        <div class="form-group">
          {{Form::label('filter_by_id', 'Filter by Name')}}
          <select class="form-control opt" name="filter_name" id="filter_name">
              <option value="nullable">Select Folder</option>
              @foreach ($users as $user)
                <option value="{{$user->id}}">{{ $user->name }}</option>
              @endforeach
            </select>
        </div>
        <button class="btn btn-primary">Submit</button>
      {!! Form::close() !!}
    </div>
    @endif
  </div>




  <div class="row" id="table_mobile">
    <div class="col-12">
      {{-- For General Messages --}}
    <h4 class="font-weight-bold">General Messages</h4>
    @if(count($posts) > 0)
      <div class="row px-2">
        @foreach($posts as $post)
          <div class="col-sm-3 px-2 py-1">
            <div class="card text-light" style="background-color: rgb(71, 32, 71)">
              <div class="card-body">
                <h4>{{$post->title}}</h4>
                <h6>Written on {{$post->created_at}} by {{$post->user->name}}</h6>
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
        @endforeach
      </div>
      @endif
      <br>
      {{-- For Private Messages --}}
      <h4 class="font-weight-bold">Private Messages</h4>
      @if(count($per_posts) > 0)
      <div class="row px-2">
        @foreach($per_posts as $post)
          <div class="col-sm-3 px-2 py-1">
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
        @endforeach
      </div>
    @else
        <p class="pt-1">No messages found</p>
    @endif
    </div>
    {{-- @if (Auth::guest() || auth()->user()->usertype == 'admin')
    <div class="col-2">
      {!! Form::open(['action' => 'PostsController@filter', 'method' => 'GET']) !!}
        <div class="form-group">
          {{Form::label('filter_by_id', 'Filter by Name')}}
          <select class="form-control opt" name="filter_name" id="filter_name">
              <option value="nullable">Select Folder</option>
              @foreach ($users as $user)
                <option value="{{$user->id}}">{{ $user->name }}</option>
              @endforeach
            </select>
        </div>
        <button class="btn btn-primary">Submit</button>
      {!! Form::close() !!}
    </div>
    @endif --}}
  </div>
  <a href="/posts/create" class="btn btn-primary mt-3">Messages</a>
</div>
@endsection