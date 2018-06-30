@extends('layouts.admin')


@section('content')

	<h1 class="text-info text-center">Comment History for Post {{$post->id}}</h1>

	@if(count($comments) > 0)
		@if(Session::has('comment_approve'))
			<p class="bg-success">{{session('comment_approve')}}</p>
		@endif
		@if(Session::has('comment_disapprove'))
			<p class="bg-danger">{{session('comment_disapprove')}}</p>
		@endif
		@if(Session::has('comment_delete'))
			<p class="bg-danger">{{session('comment_delete')}}</p>
		@endif
		<table class="table table-responsive table-bordered table-striped">
			<thead>
				<tr>
					<th>Comment Record #</th>
					<th>Author</th>
					<th>Author's Email</th>
					<th></th>
					<th>Comment</th>
					<th>Replies</th>
					<th>Posted On</th>
					<th>Last Update</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($comments as $comment)
				<tr>
					<td>{{$comment->id}}</td>
					<td><a href="#">{{$comment->author}}</a></td>
					<td><a href="mailto:{{$comment->email}}">{{$comment->email}}</a></td>
					<td>
						@if($comment->photo and strlen($comment->photo) > 0)
							<img class="img img-responsive" src="{{$comment->photo}}" height="50" width="50" />
						@else
							No Photo Available for {{$comment->author}}
						@endif
					</td>
					<td>{{$comment->body}}</td>
					<td><a href="{{route('admin.comments.replies.show',$comment->id)}}">Reply History</a></td>
					<td>{{$comment->created_at->diffForHumans()}}</td>
					<td>{{$comment->updated_at->diffForHumans()}}</td>
					<td>
						{!! Form::open(['method'=>'PATCH','action'=>['PostCommentsController@update',$comment->id]]) !!}
							<input type="hidden" name="is_active" value="{{$comment->is_active == 1 ? 0 : 1}}" />
							<div class="form-group">
								{!! Form::submit($comment->is_active ? "Disapprove Comment" : "Approve Comment",['class'=>$comment->is_active ? 'btn btn-danger' : 'btn btn-success']) !!}
							</div>
						{!! Form::close() !!}
					</td>
					<td>
						{!! Form::open(['method'=>'DELETE','action'=>['PostCommentsController@destroy',$comment->id]]) !!}
							<div class="form-group">
								{!! Form::submit(' X ',['class'=>'btn btn-danger','title'=>'Delete this Comment']) !!}
							</div>
						{!! Form::close() !!}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<h2 class="text-info text-center">No Available Comments for this Post</h2>
	@endif
@endsection