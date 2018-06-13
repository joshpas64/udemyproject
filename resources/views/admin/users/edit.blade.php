@extends('layouts.admin')


@section('content')
	<h1 class="text-primary text-center">Update User: {{$user->name}}</h1>

	<div class="row">
		<div class="col-sm-3">
			@if($user->photo)
				<img src="{{$user->photo ? $user->photo->file :'http://placehold.it/400x400'}}" class="img img-responsive img-rounded" alt="User Thumbnail" >
			@endif
		</div>

		<div class="col-sm-9">
			{!! Form::open(['method'=>'PATCH','action'=>['AdminUsersController@update',$user->id],'files'=>true]) !!}

			<div class="form-group">
				{!! Form::label('name','Name: ') !!}
				{!! Form::text('name',$user->name,['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('email','Email: ') !!}
				{!! Form::email('email',$user->email,['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('role_id','Role: ') !!}
				{!! Form::select('role_id',[''=>'Select Role for User'] + $roles,$user->role_id,['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('is_active','Status: ') !!}
				{!! Form::select('is_active',array(1 => 'Active',0=>'Not Active'),$user->is_active,['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('photo_id','File: ') !!}
				{!! Form::file('photo_id',null,['class'=>'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::submit('Update User',['class'=>'btn btn-primary']) !!}
				{!! Form::close() !!}

				{!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy',$user->id],'class'=>'pull-right']) !!}
					{!! Form::submit('Delete User',['class'=>'btn btn-danger']) !!}
<!-- 
				<div class="form-group">
					{!! Form::submit('Delete User',['class'=>'btn btn-danger']) !!}
				</div> -->

				{!! Form::close() !!}
			</div>

		</div>
	</div>

<!-- 	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-9">
			{!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy',$user->id],'class'=>'pull-right']) !!}

				<div class="form-group">
					{!! Form::submit('Delete User',['class'=>'btn btn-danger']) !!}
				</div>

			{!! Form::close() !!}
		</div>
	</div> -->


	<div class="row">
		@include('partials.form_error')
	</div>

@stop


