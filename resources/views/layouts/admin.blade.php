<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs5.min.css')}}">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>
<body class="hold-transition sidebar-mini">
    <div class="container-fluid">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">{{__("Profile")}}</a>
                </li>

                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{route('new.index')}}" class="nav-link">{{__("News")}}</a>
                </li>
            </ul>
        </nav>
        <div class="">
            @yield('content')
        </div>
        <!-- Main Footer -->
        <footer class="main-footer">
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
    </div>
<!-- ./wrapper -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('plugins/summernote/summernote-bs5.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                toolbar: [

                ]
            });
        });
    </script>

</body>
</html>

