@extends('layouts.app')

@section('content')
    <div class="px-2">
    <h4 class="font-weight-bold">Folders</h4>
        <div class="row no-gutters text-center" style="font-size: 25px ;">
            @if (count($fols) > 0)
                @foreach ($fols as $fol)
                        <div class="col-xs-4" id="fold_on_dash">
                        <a href="/folders/{{$fol->id}}" style="color: #08417a;"><i class="fa fa-folder pr-2" aria-hidden="true"></i>{{$fol->name}}</a>
                        <div class="row no-gutters">
                            <div class="col-xs-6">
                                <a class="nav-link link" href="/folders/{{$fol->id}}/edit"><i id="icon" class="fa fa-pencil-square icon" aria-hidden="true" class = "icon"></i></a>
                            </div>
                            <div class="col-xs-6">
                                {!!Form::open(['action' => ['FoldersController@destroy', $fol->id], 'method' => 'DELETE'])!!}
                                    <button type="submit" style="border: 0px; background-color:white; padding-top:6px;"><i id="icon" class="fa fa-trash icon" aria-hidden="true" class = "icon"></i></button>
                                {!!Form::close()!!}
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
        <button formaction="/deleteall" type="submit" class="btn btn-danger" style="font-size:12px;">Delete All Selected</button>
        <button formaction="" type="submit" class="btn btn-primary" style="font-size:12px;">Send to Important</button>
        <button formaction="" type="submit" class="btn btn-secondary" style="font-size:12px;">Send to Favourites</button>
        <table class="table table-borderless table-hover" id="tdata">
            <thead>
              <tr id="table_pc">
                <th>Select All <input type="checkbox" class="selectall1"></th>
                <th>Important <input type="checkbox" class="selectall2"></th>
                <th>Favourites <input type="checkbox" class="selectall3"></th>
                <th>File Name</th>
                <th>Created By</th>
                <th>Folder</th>
                <th>last Modified at</th>
                <th>Size</th>
              </tr>
            </thead>
                @foreach ($fils as $fil)
                    <tbody>
                    <tr id="table_pc">
                        <td class=""><input type="checkbox" name="ids_todelete[]" class="selectbox1" value="{{ $fil->id }}"></td>
                        <td><input type="checkbox" name="ids_tostar[]" class="selectbox2" value="{{ $fil->id }}"></td>
                        <td><input type="checkbox" name="ids_tofav[]" class="selectbox3" value="{{ $fil->id }}"></td>
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
      // for selecting all delete buttons
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
      
      // for selecting all starred buttons
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

      // for selecting all favs buttons
      $('.selectall3').click(function(){
        $('.selectbox3').prop('checked', $(this).prop('checked'));
      })
      $('.selectbox3').change(function(){
        var total = $('.selectbox3').length;
        var number = $('.selectbox3:checked').length;
        if(total == number){
          $('.selectall3').prop('checked', true);
        } else{
          $('.selectall3').prop('checked', false);
        }
      })
    </script>

@endsection