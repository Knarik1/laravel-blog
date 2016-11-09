<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel Blog</title>

    <!-- Fonts -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }

         .carousel-inner > .item > img,
         .carousel-inner > .item > a > img {
             width: 70%;
             margin: auto;
         }
    </style>
</head>
<body id="app-layout">
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
                <a class="navbar-brand" href="{{ route('user.index') }}">
                    Laravel Blog
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">

                        @if (Auth::check())
                        {{--<li><a href="{{ url('posts/create/'.Auth::user()->id) }}">New Post</a></li>--}}
                        <li><a href="{{ url('posts/create/'.Auth::id()) }}">New Post</a></li>
                        <li><a href="{{ url('/home/') }}">My Posts</a></li>

                          @endif
                    <li>
                        <div class="dropdown" style="padding-top: 3px">
                            <a class="btn btn-lg dropdown-toggle" type="button" data-toggle="dropdown">
                                Categories <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu list-group">
                                @foreach($all_categories as $category)

                                    <li class="list-group-item list-group-item-action list-group-item-success">
                                        <a class="dropdown-item" href="{{ route('category.show', $category->id) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    </li>
                            <li>
                                <div class="dropdown" style="padding-top: 3px">
                                    <a class="btn btn-lg dropdown-toggle" type="button" data-toggle="dropdown">
                                        Tags <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu list-group">
                                        @foreach($all_tags as $tag)

                                            <li class="list-group-item list-group-item-action list-group-item-success">
                                                <a class="dropdown-item" href="{{ route('tag.show', $tag->id) }}">
                                                    {{ $tag->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                            </li>
                </ul>


                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')



    <!-- JavaScripts -->
    {{--<script src="{{ asset('assets/bootsrtap/js/jquery.min.js') }}"></script>--}}{{-- not working--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/ajax.js') }}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
@yield('scripts ')
</body>
</html>
