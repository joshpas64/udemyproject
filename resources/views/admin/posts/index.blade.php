@extends('layouts.admin')

@section('content')
	<h1 class="text-primary text-center">All Posts</h1>

	<table class="table table-responsive table-hover table-striped">
		<thead>
			<tr>
				<th>Title</th>
				<th>Author</th>
				<th>Category</th>
				<th>Content Preview</th>
				<th>Preview Image</th>
				<th>Created On</th>
				<th>Last Update</th>
			</tr>
		</thead>
		<tbody>
			@if($posts)

				@foreach($posts as $post)
					<tr>
						<td><a href="{{route('admin.posts.edit',$post->id)}}">{{$post->title}}</a></td>
						<td>
							@if(Auth::user()->id == $post->user->id) 
								<a href="{{route('admin.users.edit',$post->user->id)}}">{{$post->user->name}}</a>
							@else
								{{$post->user->name}}
							@endif
						</td>
						<td>{{$post->category ? $post->category->name : "No Assigned Category"}}</td>
						<td>{{$post->body}}</td>
						<td>
							@if($post->photo)
								<img src="{{$post->photo->file}}" height="60" width="60" class="img img-responsive img-rounded" alt="Thumbnail for {{$post->title}}" style="margin:auto;" />
							@else
								No Preview Image  for <em>"{{$post->title}}"</em>
							@endif
							
						</td>
						<td>{{$post->created_at}}</td>
						<td>{{$post->updated_at->diffForHumans()}}</td>
					</tr>
				@endforeach
			@endif
		</tbody>
	</table>
@endsection