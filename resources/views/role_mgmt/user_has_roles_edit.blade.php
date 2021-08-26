@extends('layouts.accounts')

@section('page_title')
Edit User has Roles - 
@endsection

@section('role_mgmt')
active
@endsection

@section('content')
<div class="container">
  <h1 class="mb-4">User has Roles</h1>
  <div class="row">

    <!-- Add user role -->
    <div class="col-lg-6 m-auto">
      <div class="card">
        <div class="card-header">Update user role</div>
        <div class="card-body pt-3">
          @if(session('role_update_success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Success!</strong> {{ session('role_update_success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          <form action="{{ route('user_has_roles_update') }}" method="post">
            @csrf
            <div class="form-group">
              <label for="role">Select User</label>
              <input type="text" name="user_id" value="{{$user->id}}" hidden>
              <input type="text" class="form-control" value="{{$user->name}}" disabled>
              @error('user_id')
                <div class="text-danger">{{$message}}</div>
              @enderror
            </div>
            <div class="form-group">
              <label for="permission">Select Role</label>
              <Select name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                <option value="{{$model_has_roles->role_id}}" selected hidden>{{$model_has_roles->role_name}}</option>
                @foreach($roles as $role)
                <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
              </Select>
              @error('role_id')
                <div class="text-danger">{{$message}}</div>
              @enderror
            </div>
            <input class="btn btn-secondary" type="submit" value="Update">
            <a href="{{ url('user_has_roles') }}" class="btn btn-secondary">View List</a>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

@endsection