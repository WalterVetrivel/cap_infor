<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <title>Caprivi Archives</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
        <div class="container">
            <a href="{{route('home')}}" class="navbar-brand">Caprivi Archives</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navLinks">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navLinks">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="{{ route('archives') }}" class="nav-link">Archives</a></li>
                </ul>
                <form action="{{route('search')}}" method="GET" class="form-inline">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="search" placeholder="Search archives">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </div>
                </form>
                <ul class="navbar-nav ml-auto">
                    @if(!Auth::user())
                    <li class="nav-item"><a href="{{route('login')}}" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="{{route('register')}}" class="nav-link">Signup</a></li>
                    @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Welcome, {{Auth::user()->name}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @isAdmin(Auth::user())
                            <a class="btn btn-link dropdown-item" href="{{route('requests')}}">Membership Requests</a>
                            <a class="btn btn-link dropdown-item" href="{{route('new_post')}}">New Post</a>
                            <div class="dropdown-divider"></div>
                            @endisAdmin
                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-link dropdown-item">Logout</button>
                            </form>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
    <footer class="py-5 bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    Copyright &copy; Caprivi Archives {{ date('Y') }}. All rights reserved.
                </div>
            </div>
        </div>
    </footer>
    <!-- Scripts -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <!-- End Scripts -->
</body>
</html>
