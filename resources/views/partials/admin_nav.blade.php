
	<div class="navbar-header">
	            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	                <span class="sr-only">Toggle navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>
	            <a class="navbar-brand" href="/">Home</a>
	        </div>
	        <!-- /.navbar-header -->



	        <ul class="nav navbar-top-links navbar-right">


	            <!-- /.dropdown -->
	            <li class="dropdown">
	                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
	                    {{auth()->user()->name}}&nbsp;&nbsp;<i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
	                </a>
	                <ul class="dropdown-menu dropdown-user">
	                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
	                    </li>
	                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
	                    </li>
	                    <li class="divider"></li>
	                    <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
	                    </li>
	                </ul>
	                <!-- /.dropdown-user -->
	            </li>
	            <!-- /.dropdown -->


	        </ul>






	        {{--<ul class="nav navbar-nav navbar-right">--}}
	        {{--@if(auth()->guest())--}}
	        {{--@if(!Request::is('auth/login'))--}}
	        {{--<li><a href="{{ url('/auth/login') }}">Login</a></li>--}}
	        {{--@endif--}}
	        {{--@if(!Request::is('auth/register'))--}}
	        {{--<li><a href="{{ url('/auth/register') }}">Register</a></li>--}}
	        {{--@endif--}}
	        {{--@else--}}
	        {{--<li class="dropdown">--}}
	        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ auth()->user()->name }} <span class="caret"></span></a>--}}
	        {{--<ul class="dropdown-menu" role="menu">--}}
	        {{--<li><a href="{{ url('/auth/logout') }}">Logout</a></li>--}}

	        {{--<li><a href="{{ url('/admin/profile') }}/{{auth()->user()->id}}">Profile</a></li>--}}
	        {{--</ul>--}}
	        {{--</li>--}}
	        {{--@endif--}}
	        {{--</ul>--}}