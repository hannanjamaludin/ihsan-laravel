@extends('layouts.guest-app')

@section('content')
<div class="container-fluid h-100 ps-0">
    <div class="row justify-content-center align-items-center h-100">
        <!-- Left Section -->
        <div class="col-md-7 mb-0 pb-0" >
            <div class="container-fluid position-relative p-0 m-0">
                <img src="{{ asset('assets/img/login-img(2).jpeg') }}" class="img-fluid m-0" style="width: 100%; height: 670px; ">
            </div>
            <div style="position: absolute; top: 56px; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.3); padding: 0; margin: 0;"></div>
        </div>

        <!-- Right Section (Login Card) -->
        <div class="col-md-5 px-5">
            <div class="card mx-5">
                <div class="card-header bg-primary text-light">{{ __('Log Masuk') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Alamat emel') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Kata laluan') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Log Masuk') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Lupa Kata Laluan?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
