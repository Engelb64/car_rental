<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Rental Car</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/personal.css') }}" rel="stylesheet">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('head_link')

</head>

<body>
    <nav class="navbar  navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{route('index')}}">Home <span class="sr-only">(current)</span></a>
            </li>

            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{route('login')}}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('register')}}">Sign in</a>
            </li>
            @endguest

            @auth
            <ul class="navbar-nav ml-auto">

                @if (Auth()->user()->roles)
                @foreach (Auth()->user()->roles as $role)

                @if ($role->name== 'admin')
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{route('Admin Dashboard')}}" class="nav-link">Ir al panel administrativo</a>
                    </li>
                @endif

                @endforeach

                @endif
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="nav-link">Sign Out</a>
                </li>
            </ul>
        @endauth
    </nav>
    <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">
        @csrf
    </form>
    @yield('content')


    </div>
</body>

@yield('footer_script')

 <script src="/js/app.js"></script>
 <script src="/plugins/jquery/jquery.min.js"></script>
 <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 <script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
 <script src="/plugins/demo.js"></script>

</html>
