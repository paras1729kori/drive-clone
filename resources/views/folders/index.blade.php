@extends('layouts.app')

@section('content')
    <div class="px-2">
    <h4 class="font-weight-bold">Folders</h4>
    @if (count($fols) > 0)
      <form method="POST">
        @csrf
        <div class="btn-group" id="table_pc">
          <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Action
          </button>
          <div class="dropdown-menu dropdown-menu-right">
            <button formaction="/tofolderfold" type="submit" class="dropdown-item">Move to Folder</button>
            <button formaction="/tostarredfold" type="submit" class="dropdown-item">Send to Starred</button>
            <button formaction="/tofavsfold" type="submit" class="dropdown-item">Send to Favourites</button>
          </div>
          <span class="font-weight-bold ml-1 mt-1">Select All <input type="checkbox" class="selectall2"></span>
        </div>
    @endif
        <div class="row no-gutters text-center my-2" style="font-size: 25px;">
              @if (count($fols) > 0)
                @foreach ($fols as $fol)
                        <div class="col-xs-4 mr-3" id="fold_on_dash">
                          <input type="checkbox" id="table_pc" name="ids[]" class="selectbox2" value="{{ $fol->id }}">
                        <a href="/folders/{{$fol->id}}" style="color: #08417a;"><i class="fa fa-folder pr-2" aria-hidden="true"></i>{{$fol->name}}</a>
                      </form>
                        <div class="row no-gutters" style="font-size:18px;">
                            <div class="col-xs-2 ml-2" style="margin-top:2px;">
                                <a href="/folders/{{$fol->id}}/edit"><i id="icon" class="fa fa-pencil-square icon mt-2" aria-hidden="true" class = "icon"></i></a>
                            </div>
                            <div class="col-xs-4">                              
                                {!!Form::open(['action' => ['FoldersController@destroy', $fol->id], 'method' => 'DELETE'])!!}
                                    <button type="submit" style="border: 0px; background-color:white; padding-top:6px;"><i id="icon" class="fa fa-trash icon" aria-hidden="true" class = "icon"></i></button>
                                {!!Form::close()!!}                            
                            </div>
                            <div class="col-xs-6" style="padding-top:6px;">
                              @if($fol->starred == '1')
                                <i style="color:red;" id="icon" class="fa fa-star icon" aria-hidden="true" class = "icon"></i>
                              @endif
                              @if($fol->favourites == '1')
                                <i style="color:green;" id="icon" class="fa fa-heart icon" aria-hidden="true" class = "icon"></i>
                              @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <a href="/create"><button class="btn btn-success">Create Folders</button></a>

        <br><br>

        <h4 class="font-weight-bold">Files</h4>
        <form method="POST">
          @csrf
          @method('DELETE')
        @if (count($fils) > 0)
        <div class="btn-group" id="table_pc">
          <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Action
          </button>
          <div class="dropdown-menu dropdown-menu-right">
            <button formaction="/tofolderfiles" type="submit" class="dropdown-item">Move to Folder</button>
            <button formaction="/tostarredfiles" type="submit" class="dropdown-item">Send to Starred</button>
            <button formaction="/tofavsfiles" type="submit" class="dropdown-item">Send to Favourites</button>
            <button formaction="/deleteall" type="submit" class="dropdown-item">Delete All Selected</button>
          </div>
        </div>
        <table class="table table-borderless table-hover" id="tdata">
            <thead>
              <tr id="table_pc">
                <th>Select All <input type="checkbox" class="selectall1"></th>
                <th>Shared In</th>
                <th>File Name</th>
                <th>Created By</th>
                <th>Parent Folder</th>
                <th>last Modified at</th>
                <th>Size</th>
              </tr>
            </thead>
                @foreach ($fils as $fil)
                    <tbody>
                    <tr id="table_pc">
                        <td><input type="checkbox" name="ids[]" class="selectbox1" value="{{ $fil->id }}"></td>
                        <td>
                          @if($fil->starred == '1')
                            <i style="color:red;" class="fa fa-star" aria-hidden="true"></i>
                          @else
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                          @endif

                          @if($fil->favourites == '1')
                            <i style="color:green;" class="fa fa-heart" aria-hidden="true"></i>
                          @else
                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                          @endif
                        </td>
                        <td><a href="{{ route('downloadfileindash', $fil->id) }}" style="text-decoration: none;">{{$fil->name}}</a></td>
                        <td>{{$fil->userfils->name}}</td>
                        <td>{{$fil->p_files->name}}</td>
                        <td>{{$fil->updated_at}}</td>
                        <td>{{$fil->size}}</td>
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
          <a href="/create" class="btn btn-success mt-2 mb-2">Create File</a>
        </form>
    </div>

    <script type="text/javascript">
      // for selecting all buttons of files
      $('.selectall1').click(function(){
        $('.selectbox1').prop('checked', $(this).prop('checked'));
      })
      $('.selectbox1').change(function(){
        var total = $('.selectbox1').length;
        var number = $('.selectbox1:checked').length;
        if(total == number){
          $('.selectall1').prop('checked', true);
        } else{
          $('.selectall1').prop('checked', false);
        }
      })

      // for selecting all buttons of folders
      $('.selectall2').click(function(){
        $('.selectbox2').prop('checked', $(this).prop('checked'));
      })
      $('.selectbox2').change(function(){
        var total = $('.selectbox2').length;
        var number = $('.selectbox2:checked').length;
        if(total == number){
          $('.selectall2').prop('checked', true);
        } else{
          $('.selectall2').prop('checked', false);
        }
      })
    </script>

@endsection