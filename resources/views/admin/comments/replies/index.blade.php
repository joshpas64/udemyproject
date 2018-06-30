@extends('layouts.admin')

@section('content')
	<h1 class="text-primary text-center">Comment History</h1>

	@if($comments)
		<table class="table table-responsive table-striped table-bordered">
			<thead>
				<tr>
					<th>Record #</th>
					<th>Author</th>
					<th>Author's Email</th>
					<th>Post</th>
					<th>Comment</th>
					<th>Reply</th>
					<th>Posted On</th>
					<th>Last Update</th>
				</tr>
			</thead>
			<tbody>
				@foreach($comments as $comment)
					<tr>
						<td>{{$comment->id}}</td>
						<td><a href="#">{{$comment->author->name}}</a></td>
						<td><a href="mailto:{{$comment->email}}">{{$comment->email}}</a></td>
						<td><a href="{{route('admin.posts.edit',$comment->post_id)}}">{{$comment->post->name</a></td>
						<td>{{str_limit($comment->body,20)}}</td>
						<td>{{$comment->created_at->diffForHumans()}}</td>
						<td>{{$comment->updated_at->diffForHumans()}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<h2 class="text-info text-center">No Comments Available</h2>
	@endif

@endsection