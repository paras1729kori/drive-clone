@extends('layouts.app')

@section('content')
    <div class="container">
    <div id="accordion" role="tablist">
        <div class="card">
          <div class="card-header" role="tab" id="headingOne">
            <h5 class="mb-0">
              <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Upload Files
              </a>
            </h5>
          </div>
      
          <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
            <div class="card-body">
              {!! Form::open(['action' => 'FilesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
              <div class="form-group">
                <input type="file" name="file[]" multiple>
              </div>
              <div class="form-group">
                {{Form::label("parentid", "Parent Folder: $folder_name")}}
                  <select class="form-control opt" name="parentid" id="parentid">
                      <option value="{{$folder_id}}">{{ $folder_name }}</option>
                  </select>
              </div>
              {{Form::checkbox('starred', '1', $starred)}}
            {{Form::label('starred', 'Mark as Starred')}} <br>
            {{Form::checkbox('favourites', '1', $favourites)}}
            {{Form::label('favourites', 'Mark as Favourites')}}
            <br>
                {{Form::submit('Upload', ['class'=>'btn btn-primary'])}}
                {!! Form::close() !!}
            </div>
          </div>
        </div>
        <div class="card mt-2 mb-3">
          <div class="card-header" role="tab" id="headingTwo">
            <h5 class="mb-0">
              <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Create Folders
              </a>
            </h5>
          </div>
          <div id="collapseTwo" class="collapse show" role="tabpanel" aria-labelledby="headingTwo">
            <div class="card-body">
            {!! Form::open(['action' => 'FoldersController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                {{Form::hidden('parentid', 'folder_id')}}
            <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'folder name'])}}
          </div>
          <div class="form-group">
            {{Form::label("parentid", "Parent Folder: $folder_name")}}
            <select class="form-control opt" name="parentid" id="parentid">
                <option value="{{$folder_id}}">{{ $folder_name }}</option>
            </select>
          </div>
          {{Form::checkbox('starred', '1', $starred)}}
          {{Form::label('starred', 'Mark as Starred')}}<br>
          {{Form::checkbox('favourites', '1', $favourites)}}
          {{Form::label('favourites', 'Mark as Favourites')}}
           <br>
            {{Form::submit('Create', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
          </div>
          </div>
        </div>
      </div>
    </div>
@endsection