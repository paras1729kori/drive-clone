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
          <div class="table-responsive" id="table_pc">
            <table class="table">
              <thead class="text-primary">
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>UserType</th>
                <th>Status</th>
                <th>Login_Time</th>
                <th>Logout_Time</th>
              </thead>
              <tbody>
                  @foreach ($users as $user)
                    <tr>
                      <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->usertype}}</td>
                        <td>{{$user->status}}</td>
                        <td>
                          @if($user->login_time == null)
                            <p>--------</p>
                          @else
                            {{$user->login_time}}
                          @endif
                        </td>
                        <td>
                          @if($user->logout_time == null)
                            <p>--------</p>
                          @else
                            {{$user->logout_time}}
                          @endif
                        </td>
                    </tr>
                  @endforeach
                  
              </tbody>
            </table>
          </div>
          <div class="table-responsive" id="table_mobile">
            <table class="table">
            <thead class="text-primary">
              <th>Name</th>
              <th>UserType</th>
              <th>Status</th>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr>
                    <td>{{$user->name}}</td> 
                    <td>{{$user->usertype}}</td>
                    <td>{{$user->status}}</td>
                </tr>
              @endforeach
              
           </tbody>
            </table>
            <p>Switch to Destop View to access all the details of a user</p>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection


@section('scripts')
    
@endsection