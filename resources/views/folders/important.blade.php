@extends('layouts.app')

@section('content')
    <div class="px-2">
        {{-- BreadCrumbs --}}
        @if (auth()->user()->usertype == 'admin')
          <div class="px-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/{{$page[0]}}">{{$page[1]}}</a></li>
              @if (count($parents) > 0)
              @foreach(array_combine($parents, $parent_ids) as $parent => $id)
                <li class="breadcrumb-item"><a href="{{ $id }}">{{ $parent }}</a></li>
              @endforeach
              @endif
            </ol>
          </nav> 
        </div>
        @endif  

    <h4 class="font-weight-bold">Folders</h4>
        @if (count($fols) > 0)
      <form method="GET">
        @csrf
        <div class="btn-group" id="table_pc">
          <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Action
          </button>
          <div class="dropdown-menu dropdown-menu-right">
            <button formaction="/tofolderfold" type="submit" class="dropdown-item">Move to Other Folder</button>
            <button formaction="/tostarredfold" type="submit" class="dropdown-item">Send to Starred</button>
            <button formaction="/tofavsfold" type="submit" class="dropdown-item">Send to Favourites</button>
            <button formaction="/removefolstar" type="submit" class="dropdown-item">Remove From Starred</button>
            <button formaction="/removefolfavs" type="submit" class="dropdown-item">Remove From Favourites</button>
          </div>
        </div>
      <table class="table table-borderless table-hover">
        <thead id="table_pc">
          <tr>
            <th><span class="font-weight-bold ml-1 mt-1">Select All <input type="checkbox" class="selectall2"></span></th>
            <th>Shared In</th>
            <th>Folder Name</th>
            <th>Created By</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
      @foreach ($fols as $fol)
        <tbody>
          <tr id="table_pc">
            <td><input type="checkbox" id="table_pc" name="ids[]" class="selectbox2" value="{{ $fol->id }}"></td>
          </form>
            <td>
              @if($fol->starred == '1')
                <i style="color:yellow;" class="fa fa-star mr-2" aria-hidden="true"></i>
              @else
                <i class="fa fa-star-o mr-2" aria-hidden="true"></i>
              @endif

              @if($fol->favourites == '1')
                <i style="color:red;" class="fa fa-heart" aria-hidden="true"></i>
              @else
                <i class="fa fa-heart-o" aria-hidden="true"></i>
              @endif
            </td>
            <td><a href="/{{$page[0]}}/{{$fol->id}}" style="color: #08417a;">{{$fol->name}}</a></td>
            <td>{{$fol->userfols->name}}</td>
            <td><a href="/folders/{{$fol->id}}/edit"><i id="icon" class="fa fa-pencil-square icon" aria-hidden="true" class = "icon"></i></a></td>
            <td>
              {!!Form::open(['action' => ['FoldersController@destroy', $fol->id], 'method' => 'DELETE'])!!}
                  <button type="submit" style="border: 0px; background-color:white;"><i id="icon" class="fa fa-trash icon" aria-hidden="true" class = "icon"></i></button>
              {!!Form::close()!!}
            </td>
          </tr>
        </tbody>
      @endforeach
      <thead id="table_mobile">
        <tr>
          <th>Folder Name</th>
          <th>Shared In</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      @foreach ($fols as $fol)
        <tbody>
          <tr id="table_mobile">
            <td><a href="/important/{{$fol->id}}" style="color: #08417a;">{{$fol->name}}</a></td>
            <td>
              @if($fol->starred == '1')
                  <i style="color:yellow;" class="fa fa-star mr-2" aria-hidden="true"></i>
                @else
                  <i class="fa fa-star-o mr-2" aria-hidden="true"></i>
                @endif
                @if($fol->favourites == '1')
                  <i style="color:red;" class="fa fa-heart" aria-hidden="true"></i>
                @else
                  <i class="fa fa-heart-o" aria-hidden="true"></i>
                @endif
            </td>
            <td><a href="/folders/{{$fol->id}}/edit"><i id="icon" class="fa fa-pencil-square icon" aria-hidden="true" class = "icon"></i></a></td>
            <td>
              {!!Form::open(['action' => ['FoldersController@destroy', $fol->id], 'method' => 'DELETE'])!!}
                  <button type="submit" style="border: 0px; background-color:white;"><i id="icon" class="fa fa-trash icon" aria-hidden="true" class = "icon"></i></button>
              {!!Form::close()!!}
            </td>
          </tr>
        </tbody>
      @endforeach
    </table>  
    @else
      <p>No Folders Found</p>
  @endif
        <br>
        <h4 class="font-weight-bold">Files</h4>
        <form method="GET">
          @csrf
        @if (count($fils) > 0)
        <div class="btn-group" id="table_pc">
          <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Action
          </button>
          <div class="dropdown-menu dropdown-menu-right">
            <button formaction="/replace" type="submit" class="dropdown-item">Replace Files</button>
            <button formaction="/tofolderfiles" type="submit" class="dropdown-item">Move to Other Folder</button>
            <button formaction="/tostarredfiles" type="submit" class="dropdown-item">Send to Starred</button>
            <button formaction="/tofavsfiles" type="submit" class="dropdown-item">Send to Favourites</button>
            <button formaction="/removestarred" type="submit" class="dropdown-item">Remove From Starred</button>
            <button formaction="/removefavs" type="submit" class="dropdown-item">Remove From Favourites</button>
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
                            <i style="color:yellow;" class="fa fa-star mr-2" aria-hidden="true"></i>
                          @else
                            <i class="fa fa-star-o mr-2" aria-hidden="true"></i>
                          @endif

                          @if($fil->favourites == '1')
                            <i style="color:red;" class="fa fa-heart" aria-hidden="true"></i>
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
          @else
            <p>No Folders Found</p>
          @endif
          <a href="/create" class="btn btn-success">Create</a>
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