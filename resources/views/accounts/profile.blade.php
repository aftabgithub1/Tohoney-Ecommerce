@extends('layouts.accounts')

@section('page_title')
Profile - 
@endsection

@section('profile')
active 
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <h1>User Profile</h1>
    <div class="col-lg-12 pr-2">
      <div class="card">
        <div class="card-body pt-3">
          @if(session('password_change_success'))
            <div class="alert alert-success mt-4">
              {{ session('password_change_success') }}
            </div>
          @endif
          <table class="table mt-4">
            <tr>
              <th>ID</th>
              <th> : </th>
              <td>{{ $user->id }}</td>
            </tr>
            <tr>
              <th>Name</th>
              <th> : </th>
              <td>{{ $user->name }}</td>
            </tr>
            <tr>
              <th>Email</th>
              <th> : </th>
              <td>{{ $user->email }}</td>
            </tr>
            <tr>
              <th>Created at</th>
              <th> : </th>
              <td>{{ $user->created_at->format('d-M-Y h:i:s A') }}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection