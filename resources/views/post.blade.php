@extends('layouts.blog_post')


@section('content')
    <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$post->title}}</h1>

                <!-- Author -->
                <p class="lead">
                    by 
                    @if(Auth::user() and Auth::user()->is_active and Auth::user()->role->name == 'administrator')
                    	<a href="{{route('admin.users.edit',$post->user->id)}}">{{$post->user->name}}</a>
                    @else 
                    	<a href="#">{{$post->user->name}}</a>
                    @endif

                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

                <hr>

                <!-- Preview Image -->
                <!-- <img class="img-responsive" src="http://placehold.it/900x300" alt=""> -->
                @if($post->photo)
                	<img class="img img-responsive" src="{{$post->photo->file}}" style="margin: auto;" alt="Preview Thumbnail" />
                @endif

                <hr>

                <!-- Post Content -->
                {!! $post->body !!}
                <!-- <p class="lead">{{$post->body}}</p> -->
<!--                 <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p> -->

                <hr>

<!--                  @if(Session::has('comment_add'))
                	<p>{{session('comment_add')}}</p>
                @endif -->
                @include('partials.flash_messages')
                <!-- Blog Comments -->
                @if($comments and count($comments) > 0)
	               <!-- Posted Comments -->

	                <!-- Comment -->
	                @foreach($comments as $comment)
		                <div class="media">
		                	<a class="pull-left" href="#">
		                		@if($comment->photo and strlen($comment->photo) > 0)
		                			<img class="media-object" src="{{$comment->photo}}" height="64" width="64" alt="Profile Thumbnail">
		                		@else
		                        	<img class="media-object" src="http://placehold.it/64x64" alt="">
		                        	<img class="media-object" src="{{Auth::user()->gravatar}}" height="64" width="64" alt="Gravatar">
		                		@endif
		                    </a>
		                	<div class="media-body">
		                		<h4 class="media-heading">{{$comment->author}}&nbsp;&nbsp;<small>{{$comment->created_at->diffForHumans()}}</small></h4>
		                		{{$comment->body}}
		                		<div class="comment-reply-container">
		                			<button class="toggle-reply btn btn-primary pull-right">Reply</button>
		                			<div class="comment-reply col-sm-6">
						               	{!! Form::open(['method'=>'POST','action'=>'CommentRepliesController@createReply']) !!}
				                        	<input type="hidden" name="comment_id" value="{{$comment->id}}" />
				                        	<div class="form-group">
				                        		{!! Form::label('body','Reply: ') !!}
				                        		{!! Form::textarea('body',null,['class'=>'form-control','rows'=>2]) !!}
				                        	</div>

				                        	<div class="form-group">
				                        		{!! Form::submit('Submit Reply',['class'=>'btn btn-primary']) !!}
				                        	</div>
			                        	{!! Form::close() !!}
		                        	</div>
		                        </div>
			                	@if($comment->replies and count($comment->replies) > 0)
			                		@foreach($comment->replies as $reply)
			                			@if($reply->is_active == 1)
					                		<div id="nested-comment" class="media">
					                			<a class="pull-left" href="#">
					                				@if($reply->photo and strlen($reply->photo) > 0)
							                			<img class="media-object" src="{{$reply->photo}}" height="64" width="64" alt="Profile Thumbnail">
							                		@else
							                        	<img class="media-object" src="http://placehold.it/64x64" alt=""> 
							                            <img class="media-object" src="{{Auth::user()->gravatar}}" height="64" width="64" alt="Gravatar">

							                		@endif
					                			</a>
					                			<div class="media-body">
					                				<h4 class="media-heading">{{$reply->author}}&nbsp;&nbsp;<small>{{$comment->created_at->diffForHumans()}}</small></h4>
					                				{{$reply->body}}
					                			</div>
					                		</div>
					                		<div class="comment-reply-container">
					                			<button class="toggle-reply btn btn-primary pull-right">Reply</button>
					                			<div class="comment-reply col-sm-6">
									               	{!! Form::open(['method'=>'POST','action'=>'CommentRepliesController@createReply']) !!}
							                        	<input type="hidden" name="comment_id" value="{{$comment->id}}" />
							                        	<div class="form-group">
							                        		{!! Form::label('body','Reply: ') !!}
							                        		{!! Form::textarea('body',null,['class'=>'form-control','rows'=>2]) !!}
							                        	</div>

							                        	<div class="form-group">
							                        		{!! Form::submit('Submit Reply',['class'=>'btn btn-primary']) !!}
							                        	</div>
						                        	{!! Form::close() !!}
					                        	</div>
					                        </div>
					                    @endif
				                	@endforeach
			                	@endif
			                	</div>
			                		                        <!-- Nested Comment -->
	<!-- 	                        <div class="media">
		                            <a class="pull-left" href="#">
		                                <img class="media-object" src="http://placehold.it/64x64" alt="">
		                            </a>
		                            <div class="media-body">

		                                <h4 class="media-heading">Nested Start Bootstrap
		                                    <small>August 25, 2014 at 9:30 PM</small>
		                                </h4>
		                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
		                            </div>
		                        </div> -->
		                        <!-- End Nested Comment -->
		          <!--      </div>
		            @endforeach -->
	   <!--              <div class="media">
	                    <a class="pull-left" href="#">
	                        <img class="media-object" src="http://placehold.it/64x64" alt="">
	                    </a>
	                    <div class="media-body">
	                        <h4 class="media-heading">Start Bootstrap
	                            <small>August 25, 2014 at 9:30 PM</small>
	                        </h4>
	                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
	                    </div>
	                </div> -->

                <!-- Comment -->
<!-- 	                <div class="media">
	                    <a class="pull-left" href="#">
	                        <img class="media-object" src="http://placehold.it/64x64" alt="">
	                    </a>
	                    <div class="media-body">
	                        <h4 class="media-heading">Start Bootstrap
	                            <small>August 25, 2014 at 9:30 PM</small>
	                        </h4>
	                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
	                    </div>
	                </div>  -->

                @endif

                @if(Auth::check())

	                <!-- Comments Form -->
	                <div class="well">
	                    <h4>Leave a Comment:</h4>
	                    {!! Form::open(['method'=>'POST','action'=>'PostCommentsController@store']) !!}
	                    	<input type="hidden" name="post_id" value="{{$post->id}}" />
	                    	<div class="form-group">
	                    		{!! Form::label('body','Comment: ') !!}
	                    		{!! Form::textarea('body',null,['class'=>'form-control','rows'=>5]) !!}
	                    	</div>

	                    	<div class="form-group">
	                    		{!! Form::submit('Add Comment',['class'=>'btn btn-primary']) !!}
	                    	</div>
	                    {!! Form::close() !!}
<!-- `		                    <form role="form">
	                        <div class="form-group">
	                            <textarea class="form-control" rows="3"></textarea>
	                        </div>
	                        <button type="submit" class="btn btn-primary">Submit</button>
	                    </form> -->
	                </div>
                @endif 
                <hr>
            </div>


<!--                 <div id="disqus_thread"></div>
				<script>
					/**
					*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
					*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
					/*
					var disqus_config = function () {
					this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
					this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
					};
					*/
					(function() { // DON'T EDIT BELOW THIS LINE
					var d = document, s = d.createElement('script');
					s.src = 'https://udemy-laravel.disqus.com/embed.js';
					s.setAttribute('data-timestamp', +new Date());
					(d.head || d.body).appendChild(s);
					})();
				</script>
				<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript> -->
                            
@endsection

@section('footer')
<script type="text/javascript">
	$('.comment-reply-container .toggle-reply').click(function(){
		$(this).next().slideToggle('slow');
	});
</script>

@endsection