@extends('layouts.app')

@section('content')
    <div class="container">
    <h4 class="font-weight-bold">Folders</h4>
        <div class="row no-gutters text-center" style="font-size: 25px ;">
            @if (count($fols) > 0)
                @foreach ($fols as $fol)
                        <div class="col-xs-3" id="fold_on_dash">
                        <a href="/folders/{{$fol->id}}" style="color: #08417a;"><i class="fa fa-folder pr-2" aria-hidden="true"></i>{{$fol->name}}</a>
                        <div class="row no-gutters">
                            <div class="col-xs-6">
                                <a class="nav-link link" href="/folders/{{$fol->id}}/edit"><i id="icon" class="fa fa-pencil icon" aria-hidden="true" class = "icon"></i></a>
                            </div>
                            <div class="col-xs-6">
                                {!!Form::open(['action' => ['FoldersController@destroy', $fol->id], 'method' => 'DELETE'])!!}
                                    <button type="submit" style="border: 0px; background-color:white;"><i id="icon" class="fa fa-trash icon" aria-hidden="true" class = "icon"></i></button>
                                {!!Form::close()!!}
                            </div>
                        </div>
                        <br>
                    </div>
                @endforeach
            @endif
        </div>
        <a href="/create"><button class="btn btn-success">Create Folders</button></a>
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
                        <td><a href="{{ route('downloadfileinfols', $fil->id) }}" style="text-decoration: none;">{{$fil->name}}</a></td>
                        <td>{{$fil->userfils->name}}</td>
                        <td>{{$fil->updated_at}}</td>
                        <td>{{$fil->size}}</td>
                        <td>
                            {!! Form::open(['action' => ['FilesController@destroy', $fil->id], 'method' => 'DELETE']) !!}
					            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
				            {!! Form::close() !!}
                        </td>
                        </tr>
                    </tbody>
                    

                    <tbody>
                        <tr id="table_mobile">
                            <td><a href="{{ route('downloadfileinfols', $fil->id) }}" style="text-decoration: none;">{{$fil->name}}</a></td>
                            <td class="text-center">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal">
                                    <i id="icon" style="font-size: 30px;" class="fa fa-info-circle fa-lg icon" aria-hidden="true" class = "icon"></i>
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{$fil->name}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            {{$fil->userfils->name}}<br>
                                            {{$fil->updated_at}} <br>
                                            {{$fil->size}}                                      
                                            {!! Form::open(['action' => ['FilesController@destroy', $fil->id], 'method' => 'DELETE']) !!}
                                                <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                            {!! Form::close() !!}                                            
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                @endforeach
          </table>  
        @endif
        <a href="/create"><button class="btn btn-success">Create File</button></a>
    </div>
@endsection