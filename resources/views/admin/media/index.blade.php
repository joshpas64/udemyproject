@extends('layouts.admin')


@section('content')

	<h1 class="text-primary text-center">Media Repository</h1>

	@if($photos)
		<form action="delete/media" method="post" class="form-inline">
			{{csrf_field()}}
			<input type="hidden" value="{{csrf_token()}}" />
			<div class="form-group">
				<select id="file-options" name="checkBoxArray" class="form-control">
					<option value="">Delete</option>
				</select>
			</div>
			<div class="form-group">
				<input type="submit" name="delete_all" value="Submit" class="btn btn-primary">
			</div>
			<table class="table table-responsive table-striped table-bordered">
				<thead>
					<tr>
						<th><input type="checkbox" id="options" /></th>
						<th>Photo ID#</th>
						<th>Photo Name</th>
						<th>Creation Date</th>
						<th>Last Update</th>
					</tr>
				</thead>
				<tbody>
					@foreach($photos as $photo)
						<tr>
							<td><input type="checkbox" class="checkboxes" name="checkBoxArray[]" value="{{$photo->id}}"/></td>
							<td>{{$photo->id}}</td>
							<td>
								@if($photo->file)
									<img src="{{$photo->file}}" height="50" width="50" alt="Thumbnail" class="img img-responsive" />
								@else
									Media File Not Found
								@endif
							</td>
							<td>{{$photo->created_at}}</td>
							<td>{{$photo->updated_at->diffForHumans()}}</td>
<!-- 							<td style="margin: auto;">
								<input type="hidden" name="photo_id" value="{{$photo->id}}" />
								<input type="submit" value="Remove" name="delete_single" class="btn btn-danger center-block" />
							</td> -->
<!-- 							<td>
								{!! Form::open(['method'=>'DELETE','action'=>['AdminMediasController@destroy',$photo->id]]) !!}
									{!! Form::submit('X',['class'=>'btn btn-small btn-danger center-block','title'=>'Delete this Image']) !!}
								{!! Form::close() !!}
							</td> -->
						</tr>
					@endforeach
				</tbody>
			</table>
		</form>
	@else
		<div class="row">
			<p class="text-center">There are no photos available to view in the system</p>
		</div>
	@endif
@stop

@section('footer')

<script type="text/javascript">
	
	$(document).ready(function(){

		$('#options').click(function(){
			var setting = this.checked;
			$('.checkboxes').each(function(){
				this.checked  = setting;
				
			});
		});

	});
</script>
@endsection
