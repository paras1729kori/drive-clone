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
                        <td><a href="{{ route('downloadfileindash', $fil->id) }}" style="text-decoration: none;">{{$fil->name}}</a></td>
                        <td>{{$fil->created_by}}</td>
                        <td>{{$fil->updated_at}}</td>
                        <td>{{$fil->size}}</td>
                        <td>
                            {!! Form::open(['action' => ['FilesController@destroy', $fil->id], 'method' => 'DELETE']) !!}
					            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
				            {!! Form::close() !!}
                        </td>
                    </tr>
                    </tbody>
                @endforeach
                
                @foreach ($fils as $fil)
                <tbody>
                    <tr id="table_mobile">
                        <td><a href="{{ route('downloadfileindash', $fil->id) }}" style="text-decoration: none;">{{$fil->name}}</a></td>
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
                                        Created By: {{$fil->created_by}}<br>
                                        last Modified at: {{$fil->updated_at}}<br>
                                        Size: {{$fil->size}}                                      
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


{{-- <i id="icon" class="fa fa-info-circle fa-lg icon" aria-hidden="true" class = "icon"></i> --}}