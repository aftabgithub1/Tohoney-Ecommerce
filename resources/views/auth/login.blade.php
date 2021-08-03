@extends('layouts.login_reg')

@section('content')
<div class="container" style="height: 100vh">
	<div class="row align-items-center h-100">
		<div class="col-md-5 col-sm-12 mx-auto">
			<div class="card pt-4">
				<div class="card-body">
					<div class="text-center mb-5">
						<a href="{{ route('home') }}"><img src="{{ asset('dashboard_assets/images/icons8-a-64.png') }}" height="48" class='mb-4'></a> 
						<h3>{{ __('Sign In') }}</h3>
						<p>{{ __('Please sign in to continue to Admin Panel.') }}</p>
					</div>
					<form method="POST" action="{{ route('login')}}">
						@csrf
						<div class="form-group position-relative has-icon-left">
							<label for="email">{{ __('E-Mail Address') }}</label>
							<div class="position-relative">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
							<div class="clearfix">
								<label for="password">{{ __('Password') }}</label>
									@if (Route::has('password.request'))
										<a href="{{ route('password.request') }}" class='float-right'>
											<small>{{ __('Forgot Password?') }}</small>
										</a>
									@endif
							</div>
							<div class="position-relative">
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

								@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
								<div class="form-control-icon">
									<i data-feather="lock"></i>
								</div>
							</div>
						</div>

						<div class='form-check clearfix my-4'>
							<div class="checkbox float-left">
								<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

								<label class="form-check-label" for="remember">
									{{ __('Remember Me') }}
								</label>
							</div>
							<div class="float-right">
								<a href="{{ route('register') }}">{{ __("Don't have an account?") }}</a>
							</div>
						</div>
						<div class="clearfix">
							<button class="btn btn-primary float-right">{{ __('Login') }}</button>
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
