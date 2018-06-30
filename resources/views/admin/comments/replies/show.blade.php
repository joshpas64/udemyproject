@extends('layouts.admin')


@section('content')
	<h1 class="text-primary text-center">Reply History for Comment {{$comment->id}}</h1>

	@if(count($replies) > 0)

		@if(Session::has('reply_approve'))
			<p class="bg-success">{{session('reply_approve')}}</p>
		@endif
		@if(Session::has('reply_disapprove'))
			<p class="bg-danger">{{session('reply_disapprove')}}</p>
		@endif
		@if(Session::has('reply_delete'))
			<p class="bg-danger">{{session('reply_delete')}}</p>
		@endif
		<table class="table table-responsive table-striped table-bordered">
			<thead>
				<tr>
					<th>Reply Number</th>
					<th>Author</th>
					<th>Author's Email</th>
					<th>Author's Thumbnail</th>
					<th>Original Post</th>
					<th>Reply</th>
					<th>Approval Status</th>
					<th>Replied On</th>
					<th>Last Update</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($replies as $reply)
					<tr>
						<td>{{$reply->id}}</td>
						<td><a href="#">{{$reply->author}}</a></td>
						<td><a href="mailto:{{$comment->email}}">{{$reply->email}}</a></td>
						<td>
							@if($reply->photo and strlen($reply->photo) > 0)
								<img class="img img-responsive" src="{{$comment->photo}}" height="64" width="64" />
							@else
								No photo available for {{$reply->author}}
							@endif
						</td>
						<td><a href="{{route('home.post',$reply->comment->post->slug)}}">{{$reply->comment->post->title}}</a></td>
						<td>{{str_limit($reply->body,20)}}</td>
						<td>
							{!! Form::open(['method'=>'PATCH','action'=>['CommentRepliesController@update',$reply->id]]) !!}
								<input type="hidden" name="is_active" value="{{$reply->is_active == 1 ? 0 : 1}}" />
								<div class="form-group">
									{!! Form::submit($reply->is_active ? "Disapprove Reply" : "Approve Reply",['class'=>$reply->is_active ? 'btn btn-danger' : 'btn btn-success']) !!}
								</div>
							{!! Form::close() !!}
						</td>
						<td>{{$reply->created_at->diffForHumans()}}</td>
						<td>{{$reply->updated_at->diffForHumans()}}</td>
						<td>
							{!! Form::open(['method'=>'DELETE','action'=>['CommentRepliesController@destroy',$reply->id]]) !!}
								<div class="form-group">
									{!! Form::submit('X',['class'=>'btn btn-danger']) !!}
								</div>
							{!! Form::close() !!}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif
@endsection