<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin panel</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">


    @yield('head_link')

</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="dashboard" class="nav-link">Home</a>
                </li>
            </ul>
            @auth
                <ul class="navbar-nav ml-auto">
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
    </div>

    @extends('admin.layouts.sidebar')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Admin Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard">Admin Dashboard</a></li>
                            @if(!Request::is('dashboard'))
                                <li class="breadcrumb-item active">{{ Route::current()->getName() }}</li>
                            @endif
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @yield('content')
    </div>

    <script src="/js/app.js"></script>
    <script src="/plugins/jquery/jquery.min.js"></script>
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="/plugins/demo.js"></script>

    @yield('footer_scripts')

</body>

</html>
