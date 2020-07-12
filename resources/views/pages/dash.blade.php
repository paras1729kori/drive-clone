@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row text-center mt-5" style="font-size: 30px ;">
            @if (count($fols) > 0)
            @foreach ($fols as $fol) 
                <div class="col-4 p-3" id="fold_on_dash">
                <a href="/folders/{{$fol->id}}" style="color: #08417a;"><i class="fa fa-folder pr-2" aria-hidden="true"></i>{{$fol->name}}</a>
                </div>
            @endforeach
        @else
            <a href="/create"><button class="btn btn-success">Create Folder</button></a>
        @endif
        </div>
        <br><br>
        <h4 class="font-weight-bold">Files</h4>
        @if (count($fils) > 0)
        <table class="table table-borderless table-hover" id="tdata">
            <thead>
              <tr id="table_pc">
                <th>File Name</th>
                <th>Created By</th>
                <th>last Modified at</th>
                <th>Size</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
              <tr id="table_mobile">
                <th>File Name</th>
                <th class="text-center">Info</th>
              </tr>
            </thead>
                @foreach ($fils as $fil)
                    <tbody>
                    <tr id="table_pc">
                        <td>{{$fil->name}}</td>
                        <td>{{$fil->created_by}}</td>
                        <td>{{$fil->updated_at}}</td>
                        <td>{{$fil->size}}</td>
                        <td><a href="/files/{{$fil->id}}/edit"><i id="icon" class="fa fa-pencil-square-o fa-lg icon" aria-hidden="true" class = "icon"></i></td>
                        <td>
                            {!! Form::open(['action' => ['FilesController@destroy', $fil->id], 'method' => 'DELETE']) !!}
					            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
				            {!! Form::close() !!}
                        </td>
                    </tr>
                    </tbody>
                    <tbody>
                    <tr id="table_mobile">
                        <td>{{$fil->name}}</td>
                        <td class="text-center"><a href="#"><i id="icon" class="fa fa-info-circle fa-lg icon" aria-hidden="true" class = "icon"></i></td>
                    </tr>
                    </tbody>
                @endforeach
          </table>
            <a href="/create"><button class="btn btn-success">Create File</button></a>
          @endif
    </div>
    
@endsection
