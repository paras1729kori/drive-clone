@extends('layouts.master')

@section('title')
    Tasks Edit
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tasks Edit Data</h4>
                    <form action="{{url('/tasksupdate/'.$tasks->id)}}" method="POST">
                        {{ csrf_field() }}
                        {{method_field('PUT')}}
                        <div class="modal-body">
                            <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Title:</label>
                            <input type="text" name="task" class="form-control" value="{{$tasks->task}}">
                            </div>
                            <div class="form-group">
                            <label for="message-text" class="col-form-label">Sub Title:</label>
                            <input type="text" name="subtask" class="form-control"  value="{{$tasks->subtask}}">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Description:</label>
                                <textarea class="form-control " rows="6" cols="6" name="description">{{$tasks->description}}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                        <a href="{{ url('tasks') }}" class="btn btn-secondary">BACK</a>
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection