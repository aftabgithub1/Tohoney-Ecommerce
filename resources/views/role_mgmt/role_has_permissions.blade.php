@extends('layouts.accounts')

@section('page_title')
Role has Permissions - 
@endsection

@section('role_mgmt')
active
@endsection

@section('content')
<div class="container">
  <h1 class="mb-4">Role has Permissions</h1>
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
          @if(session('delete_permission_to_role_success'))
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
              <strong>Success!</strong> {{ session('delete_permission_to_role_success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          <table class="table">
            <thead>
              <tr>
                <th>Role ID</th>
                <th>Role Name</th>
                <th>Permissions</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($roles as $key => $role)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{$role->name}}</td>
                <td>
                  @foreach($role_has_permissions->where('role_id', $role->id) as $role_has_permission)
                  <span class="badge badge-success p-1 mr-1">{{$role_has_permission->permission_name}}</span>
                  @endforeach
                </td>
                <td class="text-right">
                  <div class="dropleft">
                    <a class="btn btn-sm btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <!-- <i data-feather="settings"></i> -->
                      Options
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="{{route('role_has_permissions_view', $role->id)}}">View</a>
                      <a class="dropdown-item"  href="{{route('role_has_permissions_delete', $role->id)}}">Delete</a>
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
        <div class="card-header">Add Role</div>
        <div class="card-body pt-3">
          @if(session('assign_permission_success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Success!</strong> {{ session('assign_permission_success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          <form action="{{ route('role_has_permissions_store') }}" method="post">
            @csrf
            <div class="form-group">
              <label for="role">Select Role</label>
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
            <div class="form-group">
              <label for="permission">Select Permission</label>
              <div class="row">
                <div class="col-6">
                  <input type="checkbox" name="full_control" id="full_control">
                  <label for="full_control">&nbsp;Full control</label>
                </div>
                @foreach($permissions as $permission)
                <div class="col-6">
                  <div class="form-group">
                    <input type="checkbox" name="permission_ids[]" id="{{$permission->id}}" class="per_id" value="{{$permission->id}}">
                    <label for="{{$permission->id}}">&nbsp;{{str_replace('_', ' ', $permission->name)}}</label>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
            <input class="btn btn-secondary" type="submit" value="Add">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


@section('script')
<script>
  var fullControl = document.querySelector("#full_control");
  var someControls = document.querySelectorAll(".per_id");

  fullControl.onclick = function() {
    if(fullControl.checked == true) {
      for (var singleControl of someControls) {
        singleControl.checked = true;
      }  
    } else {
      for (var singleControl of someControls) {
        singleControl.checked = false;
      }  
    }
  }
</script>
@endsection
