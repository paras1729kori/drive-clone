@extends('layouts.app')

@section('content')
    <div class="px-2">

      {{-- BreadCrumbs --}}
      <div class="px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/favourites">Favourites</a></li>
            @if (count($parents) > 0)
            @foreach(array_combine($parents, $parent_ids) as $parent => $id)
              <li class="breadcrumb-item"><a href="{{ $id }}">{{ $parent }}</a></li>
            @endforeach
            @endif
          </ol>
        </nav> 
      </div>

    <h4 class="font-weight-bold">Folders</h4>
    @if (count($fols) > 0)
      <table class="table table-borderless table-hover">
        <thead id="table_pc">
          <tr>
            <th>Shared In</th>
            <th>Folder Name</th>
            <th>Created By</th>
            <th>Edit</th>
          </tr>
        </thead>
      @foreach ($fols as $fol)
        <tbody>
          <tr id="table_pc">
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
            <td><a href="/favourites/{{$fol->id}}" style="color: #08417a;">{{$fol->name}}</a></td>
            <td>{{$fol->userfols->name}}</td>
            <td><a href="/folders/{{$fol->id}}/edit"><i id="icon" class="fa fa-pencil-square icon" aria-hidden="true" class = "icon"></i></a></td>
          </tr>
        </tbody>
      @endforeach
      <thead id="table_mobile">
        <tr>
          <th>Folder Name</th>
          <th>Shared In</th>
          <th>Edit</th>
        </tr>
      </thead>
      @foreach ($fols as $fol)
        <tbody>
          <tr id="table_mobile">
            <td><a href="/favourites/{{$fol->id}}" style="color: #08417a;">{{$fol->name}}</a></td>
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
          </tr>
        </tbody>
      @endforeach
    </table>
    @else
      <p>No Folders Found</p>  
  @endif
        <br>
        <h4 class="font-weight-bold">Files</h4>
        @if (count($fils) > 0)
        <form method="GET">
          @csrf
          <button formaction="/replace" type="submit" class="btn btn-primary">Replace Files</button>
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
                      </form>
                        <td>
                          @if($fil->starred == '1')
                            <i style="color:yellow;" class="fa fa-star" aria-hidden="true"></i>
                          @else
                            <i class="fa fa-star-o" aria-hidden="true"></i>
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
                                      Size: {{ ($fil->size) }}
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
            <p>No Files Found</p>
          @endif
          <a href="/favourites/create/{{ $current }}"><button class="btn btn-success">Create</button></a>
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