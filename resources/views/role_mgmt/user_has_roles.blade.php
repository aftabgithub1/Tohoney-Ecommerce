@extends('layouts.accounts')

@section('page_title')
User has Roles - 
@endsection

@section('role_mgmt')
active
@endsection

@section('content')
<div class="container">
  <h1 class="mb-4">User has Roles</h1>
  <div class="row">

    <!-- User role list -->
    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">Roles</div>
        <div class="card-body" style="height: 500px: overflow: auto">
          @if(session('faq_update_success'))
            <div class="alert alert-success mt-4">
              {{ session('faq_update_success') }}
            </div>
          @endif
          @if(session('delete_user_role_success'))
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
              <strong>Success!</strong> {{ session('delete_user_role_success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          <table class="table">
            <thead>
              <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($user_roles as $user_role)
              <tr>
                <td>{{$user_role->user_id}}</td>
                <td>{{$user_role->user_name}}</td>
                <td>{{$user_role->role_name}}</td>
                <td class="text-right">
                  <div class="dropleft">
                    <a class="btn btn-sm btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <!-- <i data-feather="settings"></i> -->
                      Options
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="{{route('user_has_roles_view', $user_role->user_id)}}">View</a>
                      <a class="dropdown-item"  href="{{route('user_has_roles_edit', $user_role->user_id)}}">Edit</a>
                      <a class="dropdown-item"  href="{{route('user_has_roles_delete', $user_role->user_id)}}">Delete</a>
                    </div>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan=3>Data not available!</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Add user role -->
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">Assign a role to user</div>
        <div class="card-body pt-3">
          @if(session('assign_role_to_user_success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Success!</strong> {{ session('assign_role_to_user_success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          <form action="{{ route('user_has_roles_store') }}" method="post">
            @csrf
            <div class="form-group">
              <label for="role">Select User</label>
              <Select name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                <option value=""selected disabled hidden>-- Select one --</option>
                @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
              </Select>
              @error('user_id')
                <div class="text-danger">{{$message}}</div>
              @enderror
            </div>
            <div class="form-group">
              <label for="permission">Select Role</label>
              <Select name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                <option value=""selected disabled hidden>-- Select one --</option>
                @foreach($roles as $role)
                <option value="{{$role->id}}">{{$role->name}}</option>
                @endforeach
              </Select>
              @error('role_id')
                <div class="text-danger">{{$message}}</div>
              @enderror
            </div>
            <input class="btn btn-secondary" type="submit" value="Add">
            
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

@endsection