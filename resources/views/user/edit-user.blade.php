@extends('layouts.auth-app')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb mx-3">
        <li class="breadcrumb-item"><a href="{{ route('pengguna.index_admin') }}" class="text-primary" style="text-decoration: none">Profil Pengguna</a></li>
        @if ($user->user_type == 2)
            <li class="breadcrumb-item active" aria-current="page">{{ $user->staffs->full_name }}</li>
        @else
            <li class="breadcrumb-item active" aria-current="page">{{ $user->parents->full_name }}</li>
        @endif
    </ol>
</nav>

<div class="card mb-4 mx-3">
    <div class="card-header py-1 d-flex flex-row justify-content-between card-header-divider">
        <div class="col">
            <h5 class="card-title mt-2">Profil Pengguna</h5>
        </div>
    </div>

    <div class="card-body px-3 pt-2 pb-4 w-auto">

        {{-- <form action="{{ route('pengguna.kemaskini_profil') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}
        <div class="row mt-4 px-3">
            <div class="col-6">
                <div class="form-group row">
                    <div class="col-12 pl-1">
                        <label class="form-label" for="full_name">Nama Penuh</label>
                        @if ($user->user_type == 2)
                            <input type="text" id="full_name" class="form-control" placeholder="" value="{{ $user->staffs->full_name }}" name="full_name">
                        @else
                            <input type="text" id="full_name" class="form-control" placeholder="" value="{{ $user->parents->full_name }}" name="full_name">
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group row">
                    <div class="col-12 pl-1">
                        <label class="form-label" for="utm_id">ID Staff / Pelajar</label>
                        <input type="text" id="staff_no" class="form-control" placeholder="" value="{{ $user->staff_no }}" name="staff_no">
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4 px-3">
            <div class="col-6">
                <div class="form-group row">
                    <div class="col-12 pl-1">
                        <label class="form-label" for="email">Alamat E-mel</label>
                        <input type="text" id="email" class="form-control" placeholder="" value="{{ $user->email }}" name="email">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group row">
                    <div class="col-12 pl-1">
                        <label class="form-label" for="phone_no">No. Tel</label>
                        @if ($user->user_type == 2)
                            <input type="text" id="phone_no" class="form-control" placeholder="" value="{{ $user->staffs->phone_no }}" name="phone_no">
                        @else
                            <input type="text" id="phone_no" class="form-control" placeholder="" value="{{ $user->parents->phone_no }}" name="phone_no">
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4 px-3">
            <div class="col-6">
                <div class="form-group row">
                    <div class="col-12 pl-1">
                        <label class="form-label" for="password">Kata Laluan Baharu</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="" autocomplete="new-password">
                        
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group row">
                    <div class="col-12 pl-1">
                        <label class="form-label" for="confirm_password">Sahkan Kata Laluan Baharu</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="" autocomplete="new-password">
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4 px-3">
            @if ($user->user_type == 2)
                <div class="col-6">
                    <div class="form-group row">
                        <div class="col-12 pl-1 pt-2">
                            <div class="form-check form-switch">
                                @if ($user->staffs->branch_id == 1)
                                    @if ($user->staffs->is_admin == true)
                                        <input class="form-check-input" type="checkbox" id="isAdminSwitch" checked>
                                    @else
                                        <input class="form-check-input" type="checkbox" id="isAdminSwitch">
                                    @endif
                                    <label class="form-check-label" for="isAdminSwitch">Ketua Pengasuh</label>
                                @else
                                    @if ($user->staffs->is_admin == true)
                                        <input class="form-check-input" type="checkbox" id="isAdminSwitch" checked>
                                    @else
                                        <input class="form-check-input" type="checkbox" id="isAdminSwitch">
                                    @endif
                                    <label class="form-check-label" for="isAdminSwitch">Guru Besar</label>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row">
                        <div class="col-12 pl-1 text-end">
                            <button type="button" class="btn btn-primary me-3 px-2 py-2" onclick="update_profile({{ $user->id }})"> 
                                Kemaskini Profil
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12">
                    <div class="form-group row">
                        <div class="col-12 pl-1 text-center">
                            <button type="button" class="btn btn-primary me-3 px-2 py-2" onclick="update_profile({{ $user->id }})"> 
                                Kemaskini Profil
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        {{-- </form> --}}
    </div>
</div>

@endsection

@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">

    function update_profile(id){

        var fullName = $('#full_name').val();
        var staffNo = $('#staff_no').val();
        var email = $('#email').val();
        var phoneNo = $('#phone_no').val();
        var password = $('#password').val();
        var isAdmin = $('#isAdminSwitch').is(':checked') ? 1 : 0;

        console.log(phoneNo);
        console.log(id);
        console.log(isAdmin);

        $.ajax({
            type: "POST",
            url: "{{ route('pengguna.kemaskini_profil') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "user_id": id,
                "full_name" : fullName,
                "staff_no" : staffNo,
                "email" : email,
                "phone_no": phoneNo,
                "password": password,
                "is_admin": isAdmin,
            },
            success: function(response){
                if (response.success) {
                    Swal.fire({
                        text: response.message,
                        icon: "success",
                        confirmButtonColor: '#703232'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: "Ralat",
                        text: "Profil gagal dikemaskini",
                        icon: "error",
                        confirmButtonColor: '#703232'
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while communicating with the server.',
                    confirmButtonColor: '#703232'
                });
            }
        })
    }

</script>
@endsection