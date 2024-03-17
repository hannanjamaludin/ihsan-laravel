@extends('layouts.app')

@section('guest')

    <main
        class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ Request::is('rtl') ? 'overflow-hidden' : '' }}">
        @include('layouts.navbar-app')
        <div class="container-fluid py-3 min-vh-100">
            @yield('content')
        </div>
    </main>
    
@endsection