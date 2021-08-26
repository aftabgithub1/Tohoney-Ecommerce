@extends('layouts.accounts')

@section('page_title')
User List - 
@endsection

@section('users')
active
@endsection

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
			<h4>{{ __('User List') }}<span class="float-right">Total Users: {{$total_user}}</span></h4> 
			
		</div>
		<div class="card-body">
			<table class="table mt-4">
				<tr>
					<th scope="col">Sl</th>
					<th scope="col">Name</th>
					<th scope="col">Email</th>
					<th scope="col">Created at</th>
					<th scope="col" class="text-right"></th>
				</tr>
				@foreach($users as $key => $user)
				<tr>
					<td>{{ $users->firstitem() + $key }}</td>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->created_at->format('d-M-Y h:i:s A') }}</td>
					<td class="text-right">
						<div class="dropleft">
							<a class="btn btn-sm btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<!-- <i data-feather="settings"></i> -->
								Options
							</a>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a class="dropdown-item" href="#">View</a>
								<a class="dropdown-item" href="#">Edit</a>
								<a class="dropdown-item" href="#">Delete</a>
							</div>
						</div>
					</td>
				</tr>
				@endforeach
			</table>
			{{$users->links('pagination::bootstrap-4')}}
		</div>
	</div>
</div>

@endsection
