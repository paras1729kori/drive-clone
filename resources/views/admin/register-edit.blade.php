@extends('layouts.master')

@section('title')
    Edit-Registered Users
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Role and Status for Registered User</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-md-6">
                            <form action="/registerupdate/{{ $users->id }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <form>
                                    <div class="form-group">
                                      <label>Name</label>
                                        <input type="text" class="form-control"  value="{{$users->name}}" name="username">
                                    </div>
                                    <div class="form-group">
                                        <label>Give Role</label>
                                        <select name="usertype" class="form-control">
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Give Status</label>
                                        <select name="status" class="form-control">
                                            <option value="active">active</option>
                                            <option value="disabled">disabled</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <a href="/registerrole" type="submit" class="btn btn-danger">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    
@endsection