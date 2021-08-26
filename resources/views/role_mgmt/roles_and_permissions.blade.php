@extends('layouts.accounts')

@section('page_title')
Roles and Permissions - 
@endsection

@section('role_mgmt')
active
@endsection

@section('content')
<div class="container">
  <h1 class="mb-4">Roles and Permissions</h1>
  <div class="row">

    <!-- Forms -->
    <div class="col-lg-4 pr-2">

      <!-- Add a Role -->
      <div class="card">
        <div class="card-header">Add Role</div>
        <div class="card-body pt-3">
          @if(session('role_add_success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Success!</strong> {{ session('role_add_success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          <form action="{{ route('create_role') }}" method="post">
            @csrf
            <div class="form-group">
              <input type="text" name="role_name" id="role_name" value="" class="form-control @error('role_name') is-invalid @enderror">
              @error('role_name')
                <div class="text-danger">{{$message}}</div>
              @enderror
            </div>
            <input class="btn btn-secondary" type="submit" value="Add">
          </form>
        </div>
      </div>


      <!-- Add a Permission -->
      <div class="card">
        <div class="card-header">Add Permission</div>
        <div class="card-body pt-3">
          @if(session('permission_add_success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Success!</strong> {{ session('permission_add_success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          <form action="{{ route('create_permission') }}" method="post">
            @csrf
            <div class="form-group">
              <input type="text" name="permission_name" id="permission_name" value="" class="form-control @error('permission_name') is-invalid @enderror">
              @error('permission_name')
                <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <input class="btn btn-secondary" type="submit" value="Add">
          </form>
        </div>
      </div>
    </div>

    <!-- Role List -->
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">Roles</div>
        <div class="card-body">
          @if(session('faq_update_success'))
            <div class="alert alert-success mt-4">
              {{ session('faq_update_success') }}
            </div>
          @endif
          @if(session('delete_role_success'))
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
              <strong>Success!</strong> {{ session('delete_role_success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          
          <table class="table table-sm mt-4">
            <tr>
              <th>Role</th>
              <th>Action</th>
            </tr>
            @forelse($roles as $role)
              <tr>
                <td>{{$role->name}}</td>
                <td>
                  <a href="{{route('delete_role', $role->id)}}" class="">
                    <span class="badge badge-secondary p-1 mr-1">Delete</span>
                  </a>
                </td>
              </tr>
            @empty
              No role created
            @endforelse
          </table>
        </div>
      </div>
    </div>

    <!-- Permission List -->
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">Permissions</div>
        <div class="card-body">
          @if(session('faq_update_success'))
            <div class="alert alert-success mt-4">
              {{ session('faq_update_success') }}
            </div>
          @endif
          @if(session('delete_permission_success'))
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
              <strong>Success!</strong> {{ session('delete_permission_success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          
          <table class="table table-sm mt-4">
            <tr>
              <th>Permission</th>
              <th>Action</th>
            </tr>
            @forelse($permissions as $permission)
              <tr>
                <td>{{$permission->name}}</td>
                <td>
                  <a href="{{route('delete_permission', $permission->id)}}" class="">
                    <span class="badge badge-secondary p-1 mr-1">Delete</span>
                  </a>
                </td>
              </tr>
            @empty
              No role created
            @endforelse
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection