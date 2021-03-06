<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
		jQuery(document).ready(function($){
			 $('.delete').on('submit',function(e){
				if(!confirm('Do you want to delete this item?')){
					  e.preventDefault();
				}
			  });
			 $('.togglestaff').on('submit',function(e){
				if(!confirm('Do you want to change this user staff status?')){
					  e.preventDefault();
				}
			  });
			 $('.toggleactive').on('submit',function(e){
				if(!confirm('Do you want to change this user active status? Inactive user account will not be able to login ')){
					  e.preventDefault();
				}
			  });
		});
	</script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <!-- <ul class="nav navbar-nav">
                        &nbsp;
                    </ul> -->

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        
						@else
							<li><a href="{{ route('home') }}">Home</a></li>
							@if (Auth::user()->staff)
								<li><a href="{{ route('systemdate') }}">System Date</a></li>
								<li><a href="{{ route('users.index') }}">Users</a></li>
								<li><a href="{{ route('orders-admin.index') }}">Orders</a></li>
							@else
                            
							@endif
							<li><a href="{{ route('spaces.index') }}">Spaces</a></li>
							<li><a href="{{ route('cart') }}"> <i class="fa fa-shopping-cart"></i> {{Cart::count()}} Item(s)</a></li>
							<li class="dropdown">
								
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->firstName }} {{ Auth::user()->lastName }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
										<a href="{{ route('users.show', ['id' => Auth::user()->id] ) }}">My profile</a>
										@if (! Auth::user()->staff)
											<a href="{{ route('myorder.index') }}">My order</a>
										@endif
									</li>
									<li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
