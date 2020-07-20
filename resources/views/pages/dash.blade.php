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
        <form method="POST">
          @csrf
          @method('DELETE')
          <button formaction="/deleteall" type="submit" class="btn btn-danger" style="font-size:12px;">Delete All Selected</button>
        @if (count($fils) > 0)
        <table class="table table-borderless table-hover" id="tdata">
            <thead>
              <tr id="table_pc">
                <th><input type="checkbox" class="selectall"></th>
                <th>File Name</th>
                <th>Created By</th>
                <th>last Modified at</th>
                <th>Size</th>
                <th>Delete</th>
              </tr>
              {{-- <tr id="table_mobile">
                <th>File Name</th>
                <th class="text-center">Info</th>
              </tr> --}}
            </thead>
                @foreach ($fils as $fil)
                    <tbody>
                    <tr id="table_pc">
                        <td><input type="checkbox" name="ids[]" class="selectbox" value="{{ $fil->id }}"></td>
                        <td><a href="{{ route('downloadfileindash', $fil->id) }}" style="text-decoration: none;">{{$fil->name}}</a></td>
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
          <br>
          <a href="/create" class="btn btn-success mt-2 mb-2">Create File</a>
        </form>

        <script type="text/javascript">
          $('.selectall').click(function(){
            $('.selectbox').prop('checked', $(this).prop('checked'));
          })
          $('.selectall2').click(function(){
            $('.selectbox').prop('checked', $(this).prop('checked'));
            $('.selectall').prop('checked', $(this).prop('checked'));
          })
          $('.selectbox').change(function(){
            var total = $('.selectbox').length;
            var number = $('.selectbox:checked').length;
            if(total == number){
              $('.selectall').prop('checked', true);
            } else{
              $('.selectall').prop('checked', false);
            }
          })
        </script>
    </div>
    
@endsection


{{-- <i id="icon" class="fa fa-info-circle fa-lg icon" aria-hidden="true" class = "icon"></i> --}}