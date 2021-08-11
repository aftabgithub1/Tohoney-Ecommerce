@extends('layouts.accounts')

@section('role_mgmt')
Add Role and Permission - 
@endsection

@section('faq')
active
@endsection

@section('content')
<div class="container">
  <h1 class="mb-4">Add Roles and Permissions</h1>
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

          <form action="{{ url('role_create') }}" method="post">
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

          <form action="{{ url('permission_create') }}" method="post">
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
          @if(session('delete_success'))
            <div class="alert alert-success mt-4">
              {{ session('delete_success') }}
            </div>
          @endif
          
          <ul class="mt-4">
            @forelse($roles as $role)
              <li>{{$role->name}}</li>
            @empty
              No role created
            @endforelse
          </ul>
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
          @if(session('delete_success'))
            <div class="alert alert-success mt-4">
              {{ session('delete_success') }}
            </div>
          @endif
          
          
          <ul class="mt-4">
            @forelse($permissions as $permission)
              <li>{{$permission->name}}</li>
            @empty
              No permission created
            @endforelse
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection