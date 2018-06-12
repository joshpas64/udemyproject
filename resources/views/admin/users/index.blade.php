@extends('layouts.admin')


@section('content')
	<h1 class="text-primary text-center">Users in the System</h1>

	<table class="table table-responsive table-hover table-striped">
		<thead>
			<tr>
				<th>User ID</th>
				<th>User's Name</th>
				<th>Email Address</th>
				<th>Active User</th>
				<th>Current Role</th>
				<th>Registration Timestamp</th>
				<th>Last Account Update</th>
			</tr>
		</thead>
		<tbody>
			@if($users)
				@foreach($users as $user)
					<tr>
						<td>{{$user->id}}</td>
						<td>{{$user->name}}</td>
						<td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
						<td>{{$user->is_active == 1 ? "Is Active" : "Not Active"}}</td>
						<td>{{$user->role ? $user->role->name : "No Role Assigned"}}</td>
						<td>{{$user->created_at->diffForHumans()}}</td>
						<td>{{$user->updated_at->diffForHumans()}}</td>
					</tr>
				@endforeach
			@endif
		</tbody>
	</table>
@endsection