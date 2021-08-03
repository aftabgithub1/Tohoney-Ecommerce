@extends('layouts.login_reg')

@section('content')
<div class="container">
		<div class="row">
			<div class="col-md-5 col-sm-12 mx-auto my-2">
				<div class="card pt-4">
					<div class="card-body">
						<div class="text-center mb-5">
							<a href="{{ route('home') }}"><img src="{{ asset('dashboard_assets/images/icons8-a-64.png') }}" height="48" class='mb-4'></a>
							<h3>{{ __('Sign Up') }}</h3>
							<p>{{ __('Please fill the form to register.') }}</p>
						</div>
						<form method="POST" action="{{ route('register') }}">
							@csrf
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="name">{{ __('Full Name') }}</label>
										<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

										@error('name')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>
								
								
								<div class="col-md-12">
									<div class="form-group">
										<label for="email">{{ __('Email') }}</label>
										<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

										@error('email')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="form-group">
										<label for="password">{{ __('Password') }}</label>
										<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

										@error('password')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="form-group">
										<label for="country-floating">{{ __('Confirm Password') }}</label>
										<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
									</div>
								</div>
							</diV>
							<p><a href="{{ route('login') }}">{{ __('Have an account?') }}</a></p>
							<div class="form-group">
								<div class="form-row">
									<div class="col">
										<button type="submit" class="btn btn-primary form-control">{{ __('Register') }}</button>
									</div>
									<div class="col">
										<a href="#" class="btn btn-danger form-control"><i><img src="{{asset('dashboard_assets/images/github.png')}}" alt="" width="16"></i>{{ __('Register with github') }}</a>
									</div>
								</div>
							</div>
						</form>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
