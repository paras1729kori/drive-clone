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
                {{ Form::file('file') }}
              </div>
              <div class="form-group">
                {{Form::label('parentid', 'Parent Folder')}}
                  <select class="form-control opt" name="parentid" id="parentid">
                    <option>Select Folder</option>
                    <option value="nullable">Dashboard</option>
                    @foreach ($fols as $fol)
                      <option value="{{$fol->id}}">{{ $fol->name }}</option>
                    @endforeach
                  </select>
              </div>
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
          <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'folder name'])}}
          </div>
          <div class="form-group">
            {{Form::label('parentid', 'Parent Folder')}}
            <select class="form-control opt" name="parentid" id="parentid">
              <option>Select Folder</option>
              @foreach ($fols as $fol)
                <option value="{{$fol->id}}">{{ $fol->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            {{Form::label('sub', 'Folder or Subfolder')}}
            <select id="sub" class="form-control opt" name="val">
              <option>Select Folder</option>
                <option val=0>Folder</option>
                <option val=1>Sub-Folder</option>
            </select>
          </div>
            {{Form::submit('Create', ['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
          </div>
          </div>
        </div>
      </div>
    </div>
@endsection