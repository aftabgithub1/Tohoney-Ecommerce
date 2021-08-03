@extends('layouts.login_reg')

@section('content')
<div class="container" style="height: 100vh">
	<div class="row align-items-center h-100">
		<div class="col-md-5 col-sm-12 mx-auto">
			<div class="card pt-4">
				<div class="card-body">
					<div class="text-center mb-5">
						<a href="{{ route('home') }}"><img src="{{ asset('dashboard_assets/images/icons8-a-64.png') }}" height="48" class='mb-4'></a> 
						<h3>{{ __('Reset Password') }}</h3>
					</div>
					<form method="POST" action="{{ route('password.update') }}">
						@csrf
						<input type="hidden" name="token" value="{{ $token }}">

						<div class="form-group position-relative has-icon-left">
							<label for="email">{{ __('E-Mail Address') }}</label>
							<div class="position-relative">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
								<div class="form-control-icon">
									<i data-feather="user"></i>
								</div>
							</div>
						</div>
						<div class="form-group position-relative has-icon-left">
							<label for="email">{{ __('Password') }}</label>
							<div class="position-relative">
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

								@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
								<div class="form-control-icon">
									<i data-feather="user"></i>
								</div>
							</div>
						</div>
						<div class="form-group position-relative has-icon-left">
							<label for="email">{{ __('Confirm Password') }}</label>
							<div class="position-relative">
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

								<div class="form-control-icon">
									<i data-feather="user"></i>
								</div>
							</div>
						</div>

						<div class="clearfix text-right">
							<button type="submit" class="btn btn-primary">
								{{ __('Reset Password') }}
							</button>
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
