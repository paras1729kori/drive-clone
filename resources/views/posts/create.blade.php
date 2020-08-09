@extends('layouts.app')

@section('content')
    <div class="px-4">
        <h1>Create Mesages</h1>
        {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('title', 'Title')}}
                {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
            </div>
            <div class="form-group">
                {{Form::label('body', 'Body')}}
                {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Body Text'])}}
            </div>
            <div class="form-group">
                {{Form::checkbox('general', '1')}}
                {{Form::label('general', 'General Message')}}
            </div>
            <div class="form-group">
                {{Form::label('reciever', 'Personal')}}
                <select class="form-control opt" name="reciever" id="reciever">
                    <option value="nullable">Select Folder</option>
                    @foreach ($users as $user)
                      <option value="{{$user->id}}">{{ $user->name }}</option>
                    @endforeach
                  </select>
            </div>
            {{Form::submit('Submit', ['class'=>'btn btn-primary mb-2'])}}
        {!! Form::close() !!}
    </div>
@endsection