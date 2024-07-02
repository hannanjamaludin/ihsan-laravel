@extends('layouts.guest-app')

@section('content')
<div class="container-fluid h-100 py-5">
    <div class="row justify-content-center">
        <div class="col-md-7 mb-0 pb-0">
            <div class="container-fluid position-relative p-0 m-0">
            </div>
        </div>

        <div class="col-md-5">
            <div class="container-fluid px-3">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row mb-4">
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

                    <div class="row mb-4">
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

                    <div class="row mb-4">
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

                    <div class="row mb-4">
                        <div class="input-group">
                            <div class="input-group-text">
                                <i class="fa fa-user-tie"></i>
                            </div>    
                            <input id="staffId" type="staffId" class="form-control @error('staffId') is-invalid @enderror" name="staffId" placeholder="{{ __('ID Pekerja/Pelajar UTM') }}" value="{{ old('staffId') }}" required autocomplete="staffId">

                            @error('staffId')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
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

                    <div class="row mb-4">
                        <div class="input-group">
                            <div class="input-group-text">
                                <i class="fa fa-lock"></i>
                            </div>    
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Sahkan Kata Laluan') }}" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <input type="checkbox" class="btn-check" id="btn_check_outlined_ibu" autocomplete="off" onclick="setUserType(3)" data-type="3">
                                <label class="btn btn-outline-secondary d-flex align-items-center justify-content-center w-100" for="btn_check_outlined_ibu" style="height: 50px;"><i class="fa fa-user-ninja me-2"></i> Ibu</label>
                            </div>
                            <div class="col-md-6">
                                <input type="checkbox" class="btn-check" id="btn_check_outlined_bapa" autocomplete="off" onclick="setUserType(4)" data-type="4">
                                <label class="btn btn-outline-secondary d-flex align-items-center justify-content-center w-100" for="btn_check_outlined_bapa" style="height: 50px;"><i class="fa fa-user-tie me-2"></i> Bapa</label>    
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <input type="checkbox" class="btn-check" id="btn_check_outlined_guru" autocomplete="off" onclick="setUserType(2)" data-type="2">
                                <label class="btn btn-outline-secondary d-flex align-items-center justify-content-center w-100" for="btn_check_outlined_guru" style="height: 50px;"><i class="fa fa-chalkboard-user me-2"></i> Guru</label>    
                            </div>
                            <div class="col-md-6">
                                <input type="checkbox" class="btn-check" id="btn_check_outlined_pengasuh" autocomplete="off" onclick="setUserType(5)" data-type="5">
                                <label class="btn btn-outline-secondary d-flex align-items-center justify-content-center w-100" for="btn_check_outlined_pengasuh" style="height: 50px;"><i class="fa fa-chalkboard-user me-2"></i> Pengasuh</label>    
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="user_type" id="user_type" value="1">

                    <div class="row mb-0">
                        <div class="col-md-12">
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

<script>
    $(document).ready(function() {
        console.log('js ok');
    });

    function setUserType(type) {
        console.log('type: ' + type);
        document.getElementById('user_type').value = type;

        // Uncheck all buttons
        const buttons = document.querySelectorAll('.btn-check');
        buttons.forEach(button => button.checked = false);

        // Check the clicked button
        document.querySelector(`input[data-type="${type}"]`).checked = true;
    }
</script>

@endsection

@section('css')
<style>
    body {
        overflow-x: hidden; /* Prevent horizontal scrolling */
    }

    .container-fluid {
        padding: 0 15px; /* Reduce padding if necessary */
    }

    .row {
        margin: 0; /* Reset margin if custom values are causing overflow */
    }

    .col-md-5 {
        padding: 0; /* Remove padding if causing overflow */
    }
</style>
@endsection