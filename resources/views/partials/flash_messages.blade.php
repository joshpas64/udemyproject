@if(Session::has('comment_add'))
	<div class="alert alert-success">
		<h5 class="text-center">{{session('comment_add')}}</h5>
	</div>
@endif
