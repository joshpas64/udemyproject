@extends('layouts.admin')

@section('content')
	<h1 class="text-primary text-center">Categories</h1>

	<div class="row">
		<div class="col-sm-6">
			<h2 class="text-info text-center">Add a New Category</h2>

			{!! Form::open(['method'=>'POST','action'=>'AdminCategoriesController@store']) !!}	
				<div class="form-group">
					{!! Form::label('name','Name: ') !!}
					{!! Form::text('name',null,['class'=>'form-control']) !!}
				</div>
				<div class="form-group">
					{!! Form::submit('Add Category',['class'=>'btn btn-primary']) !!}
				</div>
			{!! Form::close() !!}	
		</div>


		<div class="col-sm-6">
			@if($categories)
			<table class="table table-responsive table-striped table-bordered">
				<thead>
					<tr>
						<th>Record #</th>
						<th>Category</th>
						<th>Creation Date</th>
					</tr>
				</thead>
				<tbody>
					@foreach($categories as $category)
						<tr>
							<td>{{$category->id}}</td>
							<td><a href="{{route('admin.categories.edit',$category->id)}}" title="Edit this Post">{{$category->name}}</a></td>
							<td>{{$category->created_at ? $category->created_at->diffForHumans() : "N/A"}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			@endif
		</div>


	</div>

@stop