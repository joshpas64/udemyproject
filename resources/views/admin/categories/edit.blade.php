@extends('layouts.admin')

@section('content')
	<h1 class="text-info text-center">Edit Category: {{$category->name}}</h1>

	<div class="row">
		<div class="col-sm-6">
			{!! Form::model($category,['method'=>'PATCH','action'=>['AdminCategoriesController@update',$category->id]]) !!}
				<div class="form-group">
					{!! Form::label('name','Name:') !!}
					{!! Form::text('name',$category->name,['class'=>'form-control']) !!}
				</div>

				<div class="form-group">
					{!! Form::submit('Update Category',['class'=>'btn btn-primary col-sm-6']) !!}
				</div>
			{!! Form::close() !!}

			{!! Form::model($category,['method'=>'DELETE','action'=>['AdminCategoriesController@destroy',$category->id]]) !!}
				{!! Form::submit('Delete Category',['class'=>'btn btn-danger col-sm-6']) !!}
			{!! Form::close() !!}
		</div>
	</div>
	<div class="row">
		@include('partials/form_error')
	</div>
@stop