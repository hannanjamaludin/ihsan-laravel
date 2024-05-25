@extends('layouts.auth-app')
@section('content')

<div class="row">
    <div class="col-12">
        <form method="POST" action="{{ route('pengguna.simpan') }}">
            @csrf
            <div class="card mb-4 mx-3">

                <div class="card-header py-1 d-flex flex-row justify-content-between card-header-divider" style="background-color: #703232; color: #FFFFFF">
                    <div class="col">
                        <h5 class="card-title mt-2">Pengguna Baharu</h5>
                    </div>
                </div>

                <div class="card-body px-3 pt-2 pb-4 w-auto">
                    <div class="form-group row mt-3">
                        <div class="col-6 pl-1">
                            <label class="form-label" for="name">Nama Penuh</label>
                            <div class="input-group" style="height: 40px">
                                <input type="text" id="name" class="form-control" placeholder="" name="name" value="{{ old('name') }}" required style="border-left: 1px #d3d1d1 solid">
                                <div class="input-group-text" style="border-right: 1px #d3d1d1 solid">
                                    <i class="fa fa-user"></i>
                                </div>    
                            </div>    
                        </div>
                        <div class="col-6 pl-1">
                            <label class="form-label" for="phoneNo">No. Telefon</label>
                            <div class="input-group" style="height: 40px">
                                <input type="text" id="phoneNo" class="form-control" placeholder="" name="phoneNo" value="{{ old('phoneNo') }}" required style="border-left: 1px #d3d1d1 solid">
                                <div class="input-group-text" style="border-right: 1px #d3d1d1 solid">
                                    <i class="fa fa-phone"></i>
                                </div>    
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <div class="col-6 pl-1">
                            <label class="form-label" for="email">Alamat E-mel</label>
                            <div class="input-group" style="height: 40px">
                                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="" name="email" value="{{ old('email') }}" required style="border-left: 1px #d3d1d1 solid">
                                <div class="input-group-text" style="border-right: 1px #d3d1d1 solid">
                                    <i class="fa fa-envelope"></i>
                                </div>    
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 pl-1">
                            <label class="form-label" for="staffID">ID Pekerja/Pelajar UTM</label>
                            <div class="input-group" style="height: 40px">
                                <input type="staffID" id="staffID" class="form-control" placeholder="" name="staffID" value="{{ old('staffID') }}" required style="border-left: 1px #d3d1d1 solid">
                                <div class="input-group-text" style="border-right: 1px #d3d1d1 solid">
                                    <i class="fa fa-user-tie"></i>
                                </div>    
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mt-3">
                        <div class="col-6 pl-1">
                            <label class="form-label" for="password">Kata Laluan</label>
                            <div class="input-group" style="height: 40px">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="" required autocomplete="new-password" style="border-left: 1px #d3d1d1 solid">
                                <div class="input-group-text" style="border-right: 1px #d3d1d1 solid">
                                    <i class="fa fa-lock"></i>
                                </div>    
    
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 pl-1">
                            <label class="form-label" for="password-confirm">Sahkan Kata Laluan</label>
                            <div class="input-group" style="height: 40px">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="" required autocomplete="new-password" style="border-left: 1px #d3d1d1 solid">
                                <div class="input-group-text" style="border-right: 1px #d3d1d1 solid">
                                    <i class="fa fa-lock"></i>
                                </div>    
                            </div>
                            </div>
                    </div>
                    <div class="form-group row my-3">
                        <div class="col-6 pl-1">
                            <label class="form-label" for="user_type">Jenis Pengguna</label>
                            <select class="form-select" id="user_type" name="user_type" style="height: 40px">
                                <option selected="" disabled>Sila pilih jenis pengguna</option>
                                <option value="2">Guru</option>
                                <option value="5">Pengasuh</option>
                                <option value="3">Ibu</option>                                
                                <option value="4">Ayah</option>                                
                            </select>
                        </div>
                    </div>
                </div>

            </div>

            <div class="text-end me-3">
                <button type="submit" class="btn btn-primary btn-hantar" style="width: 100px">
                    Hantar
                </button>
            </div>

        </form>
    </div>
</div>

@endsection