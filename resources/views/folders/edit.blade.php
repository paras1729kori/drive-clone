@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mt-4">
            <div class="card-header" role="tab" id="headingTwo">
              <h5 class="mb-0">
                <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Edit Folder
                </a>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse show" role="tabpanel" aria-labelledby="headingTwo">
              <div class="card-body">
              {!! Form::open(['action' => ['FoldersController@update', $fols->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
              {{Form::label('name', 'Name')}}
              {{Form::text('name', $fols->name, ['class' => 'form-control', 'placeholder' => 'folder name'])}}
            </div>
            <div class="form-group">
              {{Form::label('parentid', 'Where')}}
              {{Form::text('parentid', $fols->parent_folder, ['class' => 'form-control', 'placeholder' => 'parentid'])}}
            </div>
            {{-- <div class="form-group">
              {{Form::label('sub', 'Folder or Subfolder')}}
              {{Form::text('sub', $fols->sub_folder, ['class' => 'form-control', 'placeholder' => 'folder id'])}}
            </div> --}}
              {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
              {!! Form::close() !!}
            </div>
            </div>
          </div>
    </div>
@endsection