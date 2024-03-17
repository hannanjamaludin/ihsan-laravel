<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Ihsan') }}</title> --}}
    <title>Ihsan</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/ihsan-logo-apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="assets/img/ihsan-logo-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="assets/img/ihsan-logo-16x16.png">
        {{-- <link rel="manifest" href="assets/img/site.webmanifest"> --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" />

    {{-- <link href="resources/sass/app.scss" rel="stylesheet"> --}}

    <!-- Scripts -->
    {{-- <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/3c8bffa6d2.js" crossorigin="anonymous"></script>
    
</head>
<body class="m-0 p-0">
    <div id="app"> 
        @auth
            @yield('auth')
        @endauth

        @guest
            @yield('guest')
            {{-- @php
                dd("masuk");
            @endphp --}}
        @endguest      
        
        
        {{-- @include('layouts.sidebar') --}}


        {{-- <!-- Sidebar -->
        <aside class="page-sidebar">
            <div class="page-logo">
                <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative"
                    data-toggle="modal" data-target="#modal-shortcut">
                    <img src="{{ url('assets/img/ihsan-logo-32x32.png') }}" class="d-inline-flex" alt="" aria-roledescription="logo">
                    <span class="page-logo-text mr-1">Ihsan</span>
                    <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                </a>
            </div>
            
            <nav id="js-primary-nav" class="primary-nav" role="navigation">
                <ul class="nav-menu">
                    <li class="list-group-item">Sidebar Item 1</li>
                    <li class="list-group-item">Sidebar Item 2</li>
                    <!-- Add more sidebar items as needed -->
                </ul>
            </nav>
        </aside> --}}

        {{-- <main class="main"> --}}
            {{-- @yield('content') --}}
        @yield('js')
        {{-- </main> --}}
    </div>
</body>
</html>
