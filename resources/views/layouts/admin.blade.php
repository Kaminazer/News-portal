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
<body class="d-flex flex-column h-screen">
    <div class="container-fluid bg-light">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light d-flex justify-content-between">
            <ul class="navbar-nav d-flex d-block">
                @auth()
                <li class="nav-item d-sm-block">
                    <a href="{{route('admin.new.index')}}" class="nav-link">{{__("Адмін панель")}}</a>
                </li>
                @endauth()

                <li class="nav-item d-sm-block">
                    <a href="{{route('new.index')}}" class="nav-link">{{__("Новини")}}</a>
                </li>
            </ul>
            @if (Route::has('login'))
                <div class="d-flex">
                    @guest()
                        <a href="{{ route('login') }}" class="d-block me-3 btn">Увійти</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="d-block btn">Зареєструватися</a>
                        @endif
                    @endguest
                </div>
            @endif
        </nav>
        <div class="">
            @yield('content')
        </div>
        <!-- Main Footer -->
        <footer class="footer-dark mt-auto">
            All rights reserved.
            <div class="float-end d-sm-block">
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

