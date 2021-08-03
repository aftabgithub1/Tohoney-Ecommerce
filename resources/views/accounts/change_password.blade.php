@extends('layouts.accounts')

@section('page_title')
Change Password - 
@endsection

@section('edit_profile')
active 
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-6 pr-2">
      <div class="card">
        <div class="card-header">Change Your Password</div>
        <div class="card-body pt-3">
          @if(session('password_change_success'))
            <div class="alert alert-success mt-4">
              {{ session('password_change_success') }}
            </div>
          @endif

          <form action="{{ route('change_password_post', ['id' => Auth::user()->id]) }}" method="post">
            @csrf
            <div class="form-group">
              <label for="old_password">Old password</label>
              <input type="password" name="old_password" id="old_password"
               class="form-control @error('old_password') is-invalid @enderror">
              @error('old_password')
                <div class="text-danger"><small>{{ $message }}</small></div>
              @enderror
              @if(session('old_password_error'))
                <div class="text-danger"><small>{{ session('old_password_error') }}</small></div>
              @endif
            </div>
            <div class="form-group">
              <label for="password">New password</label>
              <input type="password" name="password" id="password"
               class="form-control @error('password') is-invalid @enderror">
              @error('password')
                <div class="text-danger"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <div class="form-group">
              <label for="password_confirmation">Confirm password</label>
              <input type="password" name="password_confirmation" id="password_confirmation"
               class="form-control @error('password_confirmation') is-invalid @enderror">
              @error('password_confirmation')
                <div class="text-danger"><small>{{ $message }}</small></div>
              @enderror
            </div>
            <input class="btn btn-secondary" type="submit" value="Change">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection