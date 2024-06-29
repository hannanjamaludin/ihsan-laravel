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

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/ihsan-logo-apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/ihsan-logo-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/ihsan-logo-16x16.png') }}">
    
    @livewireStyles
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" />

    <link href="/DataTables/datatables.min.css" rel="stylesheet">

    {{-- Chatbot Botman --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css"> --}}

    <!-- Library Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/3c8bffa6d2.js" crossorigin="anonymous"></script>
    <script src="/DataTables/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body class="m-0 p-0 body-main">
    <div id="app"> 
        @auth
            @yield('auth')
        @endauth

        @guest
            @yield('guest')
        @endguest      
        
        @yield('js')
        @yield('css')

    </div>
    @livewireScripts
</body>
</html>
