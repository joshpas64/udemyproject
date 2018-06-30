@extends('layouts.admin')


@section('content')
	@include('partials.tinyeditor')
	<h1 class="text-info text-center">Edit this Post</h1>

	<div class="row">
		@if($post->photo)
			<div class="col-sm-6">
				<img src="{{$post->photo->file}}" alt="Post Thumbnail" class="img img-responsive">
			</div>
		@endif
		<div class={{$post->photo ? "col-sm-6" : "col-sm-12"}}>
			{!! Form::model($post,['method'=>'PATCH','action'=>['AdminPostsController@update',$post->id],'files'=>true]) !!}
				<div class="form-group">
					{!! Form::label('title','Title: ') !!}
					{!! Form::text('title',$post->title,['class'=>'form-control']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('body','Content: ') !!}
					{!! Form::textarea('body',$post->body,['class'=>'form-control','rows'=>5]) !!}
				</div>

				<div class="form-group">
					{!! Form::label('category_id','Category: ') !!}
					{!! Form::select('category_id',array(''=>'Select a Category for this Post') + $categories,$post->category,['class'=>'form-control']) !!}
				</div>

				<div class="form-group">
					{!! Form::label('photo_id','File: ') !!}
					{!! Form::file('photo_id',null,['class'=>'form-control']) !!}
				</div>

				<div class="form-group">
					{!! Form::submit('Update Post',['class'=>'btn btn-primary col-sm-4 col-sm-offset-1']) !!}
				</div>

			{!! Form::close() !!}

			{!! Form::open(['method'=>'DELETE','action'=>['AdminPostsController@destroy',$post->id]]) !!}
				<div class="form-group">
					{!! Form::submit('Delete Posts',['class'=>'btn btn-danger col-sm-4 col-sm-offset-2']) !!}
				</div>
			{!! Form::close() !!}
			
			<div class="row">
				@include('partials.form_error')
			</div>
		</div>
	</div>

@endsection