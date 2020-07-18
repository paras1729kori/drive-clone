@extends('layouts.app')

@section('content')
    <div class="container">
    <h4 class="font-weight-bold">Folders</h4>
        <div class="row no-gutters text-center" style="font-size: 25px ;">
            @if (count($fols) > 0)
                @foreach ($fols as $fol)
                        <div class="col-xs-4" id="fold_on_dash">
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
                            <td class="text-center">
                                <div id="accordion" role="tablist">
                                    <div class="card">
                                      <div class="card-header" role="tab" id="headingOne">
                                        <h5 class="mb-0">
                                          <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            {{$fil->name}}
                                          </a>
                                        </h5>
                                      </div>                             
                                      <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                                        <div class="card-body">
                                          <a href="{{ route('downloadfileindash', $fil->id) }}" style="text-decoration: none;">{{$fil->name}}</a><br>
                                          Created By: {{$fil->userfils->name}} <br>
                                          last modified at: {{$fil->updated_at}} <br>
                                          Size: {{ ($fil->size) }}<br>
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