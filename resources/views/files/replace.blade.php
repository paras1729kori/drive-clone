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
                {{Form::label('parentid', 'Parent Folder')}}
                <select class="form-control opt" name="parentid" id="parentid">
                    <option value="{{ $parent }}">{{ $fol->name }}</option>
                </select>
              </div>
                {{Form::submit('Upload', ['class'=>'btn btn-primary'])}}
                {!! Form::close() !!}
            </div>
          </div>
        </div>
    </div>  
@endsection