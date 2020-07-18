@extends('layouts.master')

@section('title')
    Registered Users Data
@endsection

@section('content')
    
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"> Registered Users</h4>
          @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead class=" text-primary">
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>UserType</th>
              </thead>
              <tbody>
                  @foreach ($users as $user)
                    <tr>
                      <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->usertype}}</td>
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
    
@endsection