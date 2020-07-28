@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mt-4">
            <div class="card-header" role="tab" id="headingTwo">
              <h5 class="mb-0">
                <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Move Folder
                </a>
              </h5>
            </div>
              <div id="collapseTwo" class="collapse show" role="tabpanel" aria-labelledby="headingTwo">
                <div class="card-body">
                    {!! Form::open(['action' => 'FoldersController@parentfols', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    {{Form::label('parentid', 'Parent Folder')}}
                        @foreach ($ids_form as $id)
                            {{Form::hidden('result[]', $id)}}
                        @endforeach
                        <select class="form-control opt" name="parentid" id="parentid">
                        <option>Select Folder</option>
                        @foreach ($fols as $fol)
                            <option value="{{$fol->id}}">{{ $fol->name }}</option>
                        @endforeach
                        </select><br>
                    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
                    {!! Form::close() !!}
              </div>
            </div>
          </div>
    </div>
@endsection