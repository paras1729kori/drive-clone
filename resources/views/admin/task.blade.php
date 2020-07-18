@extends('layouts.master')

@section('title')
    Task
@endsection

@section('content')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/savetasks" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-group">
                <label for="recipient-name" class="col-form-label">Task:</label>
                <input type="text" name="task" class="form-control" id="recipient-name">
                </div>
                <div class="form-group">
                <label for="message-text" class="col-form-label">Sub Task:</label>
                <input type="text" name="subtask" class="form-control" id="recipient-name">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Description:</label>
                    <textarea class="form-control" name="description" id="message-text"></textarea>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Delete Modal --}}
  <!-- Modal -->
<div class="modal fade" id="deleteModalpop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Task Editor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="delete_modal_form" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
        
        <div class="modal-body">
          <input type="text" id="delete_tasks_id">
          <h5>Are you sure ? you want to  delete this Task?<h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Yes, Delete it</button>
        </div>
    </form>
      </div>
    </div>
  </div>
    {{-- End Delete Modal --}}
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Tasks
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">ADD</button>
          </h4>
          
        </div>
        <style>
            .w-10p{
                width: 10% !important;
            }
        </style>
        <div class="card-body">
          <div class="table-responsive">
            <table id="dataTable" class="table table-stripped">
              <thead class=" text-primary">
                <th class="w-10p">Id</th>
                <th class="w-10p">Title</th>
                <th class="w-10p">Sub-Title</th>
                <th class="w-10p">Description</th>
                <th class="w-10p">Edit</th>
                <th class="w-10p">Delete</th>
              </thead>
              <tbody>
                  @foreach ($tasks as $data )
                  <tr>
                    <td>{{$data->id}}</td>
                    <td>{{$data->task}}</td>
                    <td>{{$data->subtask}}</td>
                    <td>
                        <div style="height: 80px; overflow: hidden">
                            {{$data->description}}
                        </div>
                    </td>
                    <td>
                        <a href="{{ url('tasks/'.$data->id) }}" class="btn btn-success">EDIT</a>
                    </td>
                    <td>
                        <a href="javascript::void(0)" class="btn btn-danger deletebtn">DELETE</a>
                  </td>
                </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection


@section('scripts')
   <script>
        $(document).ready( function () {
        $('#dataTable').DataTable();

        $('#dataTable').on('click','.deletebtn', function(){

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();

        //console.log(data);

        $('#delete_tasks_id').val(data[0]);

        $('#delete_modal_form').attr('action','/tasksdelete/'+data[0]);

        $('#deleteModalpop').modal('show');

        });
    });
   </script> 
@endsection