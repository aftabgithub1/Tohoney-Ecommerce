<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page_title') {{ config('app.name', 'Laravel') }}</title>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('dashboard_assets/css/fontawesome-5.15.2.min.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/css/bootstrap-5.0.1.css')}}">
		<link rel="stylesheet" href="{{asset('dashboard_assets/vendors/chartjs/Chart.min.css')}}">
		<link rel="stylesheet" href="{{asset('dashboard_assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
		<link rel="stylesheet" href="{{asset('dashboard_assets/css/app.css')}}">
		<link rel="shortcut icon" href="{{asset('dashboard_assets/images/icons8-a-64.png')}}" type="image/x-icon">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
	<div id="app">
		<div id="sidebar" class='active'>
			<div class="sidebar-wrapper active">
				<div class="sidebar-header text-center">
					<a href="{{ route('home') }}">
						<img src="{{ asset('dashboard_assets/images/icons8-a-64.png') }}" alt="" srcset="">
					</a>
				</div>
				<div class="sidebar-menu">
					<ul class="menu">
						
							<li class='sidebar-title'>{{ __('Main Menu') }}</li>
						
							<li class="sidebar-item @yield('dashboard')">
								<a href="{{ url('admin_panel') }}" class='sidebar-link'>
									<i data-feather="home" width="20"></i> 
									<span>{{ __('Dashboard') }}</span>
								</a>
							</li>
						
							<li class="sidebar-item  has-sub  @yield('users')">
								<a href="#" class='sidebar-link'>
									<i data-feather="triangle" width="20"></i> 
									<span>{{ __('Account') }}</span>
								</a>
								
								<ul class="submenu ">
									<li><a href="{{ url('user_list') }}">{{ __('User List') }}</a></li>
									<li><a href="{{ url('profile') }}">{{ __('Profile') }}</a></li>
									<li><a href="{{ url('change_password') }}">{{ __('Change Password') }}</a></li>
								</ul>
							</li>
						
							<li class="sidebar-item  has-sub  @yield('role_mgmt')">
								<a href="#" class='sidebar-link'>
									<i data-feather="triangle" width="20"></i> 
									<span>{{ __('Role management') }}</span>
								</a>
								
								<ul class="submenu ">
									<li><a href="{{ url('add_role_and_permission') }}">{{ __('Add Role and Permission') }}</a></li>
									<li><a href="{{ url('add_user_role') }}">{{ __('Add User Role') }}</a></li>
								</ul>
							</li>
													
							<li class="sidebar-item @yield('product_orders')">
								<a href="{{ url('product_orders') }}" class='sidebar-link'>
									<i data-feather="home" width="20"></i> 
									<span>{{ __('Product Orders') }}</span>
								</a>
							</li>
									
							@if(Auth::user()->role == 1)
							<li class="sidebar-item @yield('faq')">
								<a href="{{ url('add_faq') }}" class='sidebar-link'>
									<i data-feather="home" width="20"></i> 
									<span>{{ __('FAQ') }}</span>
								</a>
							</li>
						
							<li class="sidebar-item  has-sub  @yield('product')">
								<a href="#" class='sidebar-link'>
									<i data-feather="triangle" width="20"></i> 
									<span>{{ __('Products') }}</span>
								</a>
								
								<ul class="submenu ">
									<li><a href="{{ route('category.index') }}">{{ __('Category') }}</a></li>
									<li><a href="{{ route('category.create') }}">{{ __('Add Category') }}</a></li>
									<li><a href="{{ route('product.index') }}">{{ __('Product') }}</a></li>
									<li><a href="{{ route('product.create') }}">{{ __('Add Product') }}</a></li>
								</ul>
							</li>
						
							<li class="sidebar-item  has-sub  @yield('coupon')">
								<a href="#" class='sidebar-link'>
									<i data-feather="triangle" width="20"></i> 
									<span>{{ __('Coupon') }}</span>
								</a>
								
								<ul class="submenu ">
									<li><a href="{{ route('coupon.index') }}">{{ __('Coupon') }}</a></li>
									<li><a href="{{ route('coupon.create') }}">{{ __('Add Coupon') }}</a></li>
								</ul>
							</li>
																				
							<li class="sidebar-item @yield('trash')">
								<a href="{{ url('trash') }}" class='sidebar-link'>
									<i data-feather="home" width="20"></i> 
									<span>{{ __('Trash') }}</span>
								</a>
							</li>
							@endif
					</ul>
				</div>
				<button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
			</div>
		</div>
		<div id="main">

			<nav class="navbar navbar-header navbar-expand navbar-light">
				<a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
				<button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
						<li class="dropdown nav-icon">
							<a href="#" data-toggle="dropdown" class="nav-link  dropdown-toggle nav-link-lg nav-link-user">
								<div class="d-lg-inline-block">
									<i data-feather="bell"></i>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-large">
								<h6 class='py-2 px-4'>Notifications</h6>
								<ul class="list-group rounded-none">
									<li class="list-group-item border-0 align-items-start">
										<div class="avatar bg-success mr-3">
											<span class="avatar-content"><i data-feather="shopping-cart"></i></span>
										</div>
										<div>
											<h6 class='text-bold'>New Order</h6>
											<p class='text-xs'>
												An order made by Ahmad Saugi for product Samsung Galaxy S69
											</p>
										</div>
									</li>
								</ul>
							</div>
						</li>
						<li class="dropdown nav-icon mr-2">
							<a href="#" data-toggle="dropdown" class="nav-link  dropdown-toggle nav-link-lg nav-link-user">
								<div class="d-lg-inline-block">
									<i data-feather="mail"></i>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item active" href="#"><i data-feather="mail"></i> Messages</a>
								<a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{ route('logout') }}"
										onclick="event.preventDefault();
																	document.getElementById('logout-form').submit();">
										<i data-feather="log-out"></i> {{ __('Logout') }}
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
										@csrf
								</form>
							</div>
						</li>
						<li class="dropdown">
							<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
								<div class="avatar mr-1">
									<img src="dashboard_assets/images/avatar/avatar-s-1.png" alt="" srcset="">
								</div>
								<div class="d-none d-md-block d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item active" href="#"><i data-feather="mail"></i> Messages</a>
								<a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{ route('logout') }}"
										onclick="event.preventDefault();
																	document.getElementById('logout-form').submit();">
										<i data-feather="log-out"></i> {{ __('Logout') }}
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
										@csrf
								</form>
							</div>
						</li>
					</ul>
				</div>
			</nav>
			


			@yield('breadcrumb');
			
			@yield('content');

			<footer>
				<div class="footer clearfix mb-0 text-muted">
					<div class="float-left">
						<p>2020 &copy; Voler</p>
					</div>
					<div class="float-right">
						<p>Crafted with <span class='text-danger'><i data-feather="heart"></i></span> by <a href="http://ahmadsaugi.com">{{ Auth::user()->name }}</a></p>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<script src="{{asset('dashboard_assets/js/bootstrap-5.0.1.min.js')}}"></script>
	<script src="{{asset('dashboard_assets/js/feather-icons/feather.min.js')}}"></script>
	<script src="{{asset('dashboard_assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
	<script src="{{asset('dashboard_assets/js/app.js')}}"></script>
	
	<script src="{{asset('dashboard_assets/vendors/chartjs/Chart.min.js')}}"></script>
	<script src="{{asset('dashboard_assets/vendors/apexcharts/apexcharts.min.js')}}"></script>
	<script src="{{asset('dashboard_assets/js/pages/dashboard.js')}}"></script>
	<script src="{{asset('dashboard_assets/js/pages/fontawesome-5.15.2.min.js')}}"></script>

	<script src="{{asset('dashboard_assets/js/main.js')}}"></script>
</body>
</html>
