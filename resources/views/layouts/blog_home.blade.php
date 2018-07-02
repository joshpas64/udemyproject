@include('partials.header')
<body>
    @include('partials.home_nav')
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                @yield('content')
                <!-- First Blog Post -->
<!--                 @foreach($posts as $post)
                    <h2>
                        <a href="#">{{$post->title}}</a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php">{{$post->author}}</a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span>{{$post->created_at->diffForHumans()}}</p>
                    <hr>
                    <img class="img-responsive" src="{{$post->photo && $post->photo->file ? $post->photo->file : 'http://placehold.it/900x300'}}" alt="Preview Image">
                    <hr>
                    {!! $post->body !!}
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, veritatis, tempora, necessitatibus inventore nisi quam quia repellat ut tempore laborum possimus eum dicta id animi corrupti debitis ipsum officiis rerum.</p>
                    <a class="btn btn-primary" href="{{route('home.post',$post->slug)}}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr> 
                @endforeach -->
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
                <!-- <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        {{$posts->links()}}
                    </div>
                </div> -->

            </div>

            @include('partials.home_side_nav')

@include('partials.footer')