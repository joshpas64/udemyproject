@extends('layouts.blog_home')

@section('content')
<!-- <div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> -->
    <!-- Blog Post Entries -->
    @if($posts and count($posts) > 0)
        @foreach($posts as $post)
            <h2>
                <a href="{{route('home.post',$post->slug)}}">{{$post->title}}</a>
            </h2>
            <p class="lead">
                by {{$post->user->name}}
            </p>
            <p><span class="glyphicon glyphicon-time"></span>{{$post->created_at->diffForHumans()}}</p>
            <hr>
            <img class="img-responsive" src="{{$post->photo && $post->photo->file ? $post->photo->file : 'http://placehold.it/900x300'}}" alt="Preview Image">
            <hr>
            <p class="lead">{!! str_limit($post->body,100) !!}</p>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum officiis rerum.</p> -->
            <a class="btn btn-primary" href="{{route('home.post',$post->slug)}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>
        @endforeach
    @endif
    <!-- Pager -->
    <!--                 <ul class="pager">
        <li class="previous">
            <a href="#">&larr; Older</a>
        </li>
        <li class="next">
            <a href="#">Newer &rarr;</a>
        </li>
    </ul> -->
    <!-- Pagination Component -->
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            {{$posts->links()}}
        </div>
    </div>
@endsection
