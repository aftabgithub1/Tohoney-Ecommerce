@extends('layouts.login_reg')

@section('content')
<div class="container" style="height: 100vh">
	<div class="row align-items-center h-100">
		<div class="col-md-5 col-sm-12 mx-auto">
			<div class="card pt-4">
				<div class="card-body">
					@if (session('status'))
							<div class="alert alert-success">
									{{ session('status') }}
							</div>
					@endif
					<div class="text-center mb-5">
						<a href="{{ route('home') }}"><img src="{{ asset('dashboard_assets/images/icons8-a-64.png') }}" height="48" class='mb-4'></a> 
						<h3>{{ __('Send Email') }}</h3>
						<p>{{ __('Send a link to your email to reset your password.') }}</p>
					</div>
					<form method="POST" action="{{ route('password.email')}}">
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

						<div class="clearfix text-right">
							<a href="{{ route('login') }}" class="btn btn-primary">{{ __('Go back') }}</a>
							<button type="submit" class="btn btn-primary">
								{{ __('Send Password Reset Link') }}
							</button>
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
</div>


<!-- <div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Reset Password') }}</div>

				<div class="card-body">
					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif

					<form method="POST" action="{{ route('password.email') }}">
						@csrf

						<div class="form-group row">
							<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

							<div class="col-md-6">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-6 offset-md-4">
								@if(isset($_SERVER['HTTP_REFERER']))
									<a href="{{$_SERVER['HTTP_REFERER']}}" class="btn btn-primary">{{ __('Cancel') }}</a>
								@endif
								<button type="submit" class="btn btn-primary">
									{{ __('Send Password Reset Link') }}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div> -->
@endsection
