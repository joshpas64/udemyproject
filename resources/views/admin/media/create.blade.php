@extends('layouts.admin')

@section('styles')
	<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css" rel="stylesheet" />
@endsection

@section('content')
	<h1 class="text-primary text-center">Upload a File</h1>

	<!-- 
		https://cdnjs.cloudfare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js
	-->
	<div class="row">
		<div class="col-sm-12">
			{!! Form::open(['method'=>'POST','action'=>'AdminMediasController@store','class'=>'dropzone']) !!}

			{!! Form::close() !!}
		</div>
	</div>

@endsection


@section('footer')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.js"></script>
@endsection