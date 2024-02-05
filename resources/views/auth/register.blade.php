@extends('layouts.app')

@section('content')
<div class="container-fluid h-100 py-5 px-5">
    <div class="row justify-content-center">
        <div class="col-md-7 mb-0 pb-0" >
            <div class="container-fluid position-relative p-0 m-0">
            </div>
        </div>

        <div class="col-md-5">
            <div class="container-fluid px-5">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row mb-4 me-5">
                        {{-- <label for="name" class="mb-2">{{ __('Nama Penuh') }}</label> --}}

                        <div class="input-group">
                            <div class="input-group-text">
                                <i class="fa fa-user"></i>
                            </div>    
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nama Penuh" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4 me-5">
                        {{-- <label for="phoneNo" class="mb-2">{{ __('No. Telefon') }}</label> --}}

                        <div class="input-group">
                            <div class="input-group-text">
                                <i class="fa fa-phone"></i>
                            </div>    
                            <input id="phoneNo" type="text" class="form-control @error('phoneNo') is-invalid @enderror" name="phoneNo" placeholder="{{ __('No. Telefon') }}" value="{{ old('phoneNo') }}" required autocomplete="phoneNo" autofocus>

                            @error('phoneNo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-4 me-5">
                        {{-- <label for="email" class="mb-2">{{ __('Alamat Emel') }}</label> --}}

                        <div class="input-group">
                            <div class="input-group-text">
                                <i class="fa fa-envelope"></i>
                            </div>    
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{ __('Alamat Emel') }}" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4 me-5">

                        <div class="input-group">
                            <div class="input-group-text">
                                <i class="fa fa-user"></i>
                            </div>    
                            <input id="staffID" type="staffID" class="form-control @error('staffID') is-invalid @enderror" name="staffID" placeholder="{{ __('ID Pekerja/Pelajar UTM') }}" value="{{ old('staffID') }}" required autocomplete="staffID">

                            @error('staffID')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-4 me-5">
                        {{-- <label for="password" class="mb-2">{{ __('Kata Laluan') }}</label> --}}

                        <div class="input-group">
                            <div class="input-group-text">
                                <i class="fa fa-lock"></i>
                            </div>    
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Kata Laluan') }}" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4 me-5">
                        {{-- <label for="password-confirm" class="mb-2">{{ __('Sahkan Kata Laluan') }}</label> --}}

                        <div class="input-group">
                            <div class="input-group-text">
                                <i class="fa fa-lock"></i>
                            </div>    
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Sahkan Kata Laluan') }}" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="mb-3 me-5">
                        <div class="row mb-4 me-2">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-outline-secondary w-100" style="height: 50px;" onclick="setUserType(3)" data-type="3">
                                    <i class="fa fa-user-tie me-2"></i> Ibu/bapa
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-outline-secondary w-100" style="height: 50px;" onclick="setUserType(2)" data-type="2">
                                    <i class="fa fa-user-graduate me-2"></i>Guru
                                </button>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="user_type" id="user_type" value="1">

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-1">
                            <button type="submit" class="btn btn-primary w-100">
                                {{ __('Daftar') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
{{-- <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
crossorigin="anonymous"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script> --}}

<script>

    // 27/01/2024 error setUserType is not defined & console.log('js ok') is not executed
    $(document).ready(function() {
        console.log('js ok');
        
    });

    function setUserType(type) {

        console.log('type: ' + type);
        // reset the styles of all buttons
        document.querySelectorAll('.btn-outline-secondary').forEach(function (button) {
            button.classList.remove('btn-selected');
        });

        var buttons = document.querySelectorAll('.btn-outline-secondary[data-type="' + type + '"]');

        if (buttons.length > 0) {
            buttons.forEach(function (button) {
                button.classList.add('btn-selected');
            });
        }

        document.getElementById('user_type').value = type;
    }

    


</script>

@endsection