@extends('layouts.login_reg')

@section('content')
<div class="container" style="height: 100vh">
	<div class="row align-items-center h-100">
		<div class="col-md-5 col-sm-12 mx-auto">
			<div class="card pt-4">
				<div class="card-body">
					<div class="text-center mb-5">
						<a href="{{ route('home') }}"><img src="{{ asset('dashboard_assets/images/icons8-a-64.png') }}" height="48" class='mb-4'></a> 
						<h3>{{ __('Verify Email Address') }}</h3>
					</div>

                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    <p>{{ __('Before proceeding, please check your email for a verification link. If you did not receive the email') }},</p>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
					
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
