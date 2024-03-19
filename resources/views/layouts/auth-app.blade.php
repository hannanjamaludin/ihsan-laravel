@extends('layouts.app')

@section('auth')


<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ Request::is('rtl') ? 'overflow-hidden' : '' }}">
    <div class="container-fluid py-0 min-vh-100">
        <div class="row">
            <div class="col-auto col-md-4 col-lg-3 min-vh-100">
                <livewire:components.sidebar />
            </div>
            <div class="col-lg-9">
                @include('layouts.navbar-app')
                <div class="container-fluid py-3 min-vh-100">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</main>

{{-- <livewire:components.sidebar />

<main
    class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ Request::is('rtl') ? 'overflow-hidden' : '' }}">
    @include('layouts.navbar-app')
    <div class="container-fluid py-3 min-vh-100">
        @yield('content')
    </div>
</main> --}}


@endsection