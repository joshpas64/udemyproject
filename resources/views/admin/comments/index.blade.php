@extends('layouts.admin')

@section('content')
	<h1 class="text-primary text-center">Comment History</h1>

	@if($comments)
		@if(Session::has('comment_approve'))
			<p class="bg-success">{{session('comment_approve')}}</p>
		@endif
		@if(Session::has('comment_disapprove'))
			<p class="bg-danger">{{session('comment_disapprove')}}</p>
		@endif
		@if(Session::has('comment_delete'))
			<p class="bg-danger">{{session('comment_delete')}}</p>
		@endif
		<table class="table table-responsive table-striped table-bordered">
			<thead>
				<tr>
					<th>Record #</th>
					<th>Author</th>
					<th>Author's Email</th>
					<th>Post</th>
					<th>Post Link</th>
					<th>Comment</th>
					<th>Reply History</th>
					<th>Approved</th>
					<th>Posted On</th>
					<th>Last Update</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($comments as $comment)
					<tr>
						<td>{{$comment->id}}</td>
						<td><a href="#">{{$comment->author}}</a></td>
						<td><a href="mailto:{{$comment->email}}">{{$comment->email}}</a></td>
						<td><a href="{{route('admin.posts.edit',$comment->post_id)}}">{{$comment->post->title}}</a></td>
						<td><a href="{{route('home.post',$comment->post->slug)}}">View Post</a></td>
						<td>{{str_limit($comment->body,20)}}</td>
						<td><a href="{{route('admin.comments.replies.show',$comment->id)}}">Reply History</a></td>
						<td>
							{!! Form::open(['method'=>'PATCH','action'=>['PostCommentsController@update',$comment->id]]) !!}
								<input type="hidden" name="is_active" value="{{$comment->is_active == 1 ? 0 : 1}}" />
								<div class="form-group">
									{!! Form::submit($comment->is_active ? "Disapprove Comment" : "Approve Comment",['class'=>$comment->is_active ? 'btn btn-danger' : 'btn btn-success']) !!}
								</div>
							{!! Form::close() !!}
						</td>
						<td>{{$comment->created_at->diffForHumans()}}</td>
						<td>{{$comment->updated_at->diffForHumans()}}</td>
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
		<h2 class="text-info text-center">No Comments Available</h2>
	@endif

@endsection