@extends('layouts.admin')


@section('content')
	<h1 class="text-primary text-center">Add a New Post</h1>

	{!! Form::open(['method'=>'POST','action'=>'AdminPostsController@store','files'=>true]) !!}


	<div class="form-group">
		{!! Form::label('title','Title: ') !!}
		{!! Form::text('title',null,['class'=>'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('category_id','Category: ') !!}
		{!! Form::select('category_id',array(''=>'Select a Category for this Post'),null,['class'=>'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('body','Content: ') !!}
		{!! Form::textarea('body',null,['class'=>'form-control','rows'=>5]) !!}
	</div>

	<div class="form-group">
		{!! Form::label('photo_id','File: ') !!}
		{!! Form::file('photo_id',null,['class'=>'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Create Post',['class'=>'btn btn-primary']) !!}
	</div>

	{!! Form::close() !!}
	<div class="row">
		@include('partials.form_error')
	</div>
@endsection
