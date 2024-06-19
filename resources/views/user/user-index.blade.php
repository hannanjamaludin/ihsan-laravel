@extends('layouts.auth-app')
@section('content')

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
                        @if ($user->user_type == 1 || $user->user_type == 2)
                            <input type="text" id="full_name" class="form-control" placeholder="" value="{{ $user->staffs->full_name }}" name="full_name" disabled>
                        @else
                            <input type="text" id="full_name" class="form-control" placeholder="" value="{{ $user->parents->full_name }}" name="full_name" disabled>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group row">
                    <div class="col-12 pl-1">
                        <label class="form-label" for="utm_id">ID Staff / Pelajar</label>
                        <input type="text" id="staff_no" class="form-control" placeholder="" value="{{ $user->staff_no }}" name="staff_no" disabled>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4 px-3">
            <div class="col-6">
                <div class="form-group row">
                    <div class="col-12 pl-1">
                        <label class="form-label" for="email">Alamat E-mel</label>
                        <input type="text" id="email" class="form-control" placeholder="" value="{{ $user->email }}" name="email" disabled>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group row">
                    <div class="col-12 pl-1">
                        @if ($user->user_type == 3 || $user->user_type == 4)
                            <label class="form-label" for="job">Pekerjaan</label>
                            <input type="text" id="job" class="form-control" placeholder="" value="{{ $user->parents->job }}" name="job">
                        @else
                            <label class="form-label" for="position">Jawatan</label>
                            @if ($user->staffs->branch_id == 1)
                                @if ($user->staffs->is_admin)
                                    <input type="text" id="position" class="form-control" placeholder="" value="Ketua Pengasuh" name="position" disabled>
                                @else
                                    <input type="text" id="position" class="form-control" placeholder="" value="Pengasuh" name="position" disabled>
                                @endif
                            @elseif ($user->staffs->branch_id == 2)
                                @if ($user->staffs->is_admin)
                                    <input type="text" id="position" class="form-control" placeholder="" value="Guru besar" name="position" disabled>
                                @else                                    
                                    <input type="text" id="position" class="form-control" placeholder="" value="Guru" name="position" disabled>
                                @endif
                            @else {{-- Admin --}}
                                <input type="text" id="position" class="form-control" placeholder="" value="Admin" name="position" disabled>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if ($user->user_type == 2)
            <div class="row mt-4 px-3">
                <div class="col-6">
                    <div class="form-group row">
                        <div class="col-12 pl-1">
                            <label class="form-label" for="branch_name">Cawangan</label>
                            <input type="text" id="branch_name" class="form-control" placeholder="" value="{{ $user->staffs->branch->branch_name }}" name="branch_name" disabled>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row">
                        <div class="col-12 pl-1">
                            @if ($user->staffs->branch->id == 1)
                                <label class="form-label" for="assignedClass">Pengasuh Bilik</label>
                                <input type="text" id="assignedClass" class="form-control" placeholder="" value="{{ $user->staffs->assignedClass->class_name ?? ' '}}" name="assignedClass" disabled>
                            @else
                                <label class="form-label" for="assignedClass">Guru Kelas</label>
                                <input type="text" id="assignedClass" class="form-control" placeholder="" value="{{ $user->staffs->assignedClass->age ?? '' }} {{ $user->staffs->assignedClass->class_name ?? '' }}" name="assignedClass" disabled>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row mt-4 px-3">
            <div class="col-6">
                <div class="form-group row">
                    <div class="col-12 pl-1">
                        <label class="form-label" for="phone_no">No. Tel</label>
                        @if ($user->user_type == 1 || $user->user_type == 2)
                            <input type="text" id="phone_no" class="form-control" placeholder="" value="{{ $user->staffs->phone_no }}" name="phone_no">
                        @else
                            <input type="text" id="phone_no" class="form-control" placeholder="" value="{{ $user->parents->phone_no }}" name="phone_no">
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group row">
                    <div class="col-12 pl-1">
                        <label class="form-label" for="ic_no">No. Kad Pengenalan</label>
                        @if ($user->user_type == 1 || $user->user_type == 2)
                            <input type="text" id="ic_no" class="form-control" placeholder="" value="{{ $user->staffs->ic_no ?? '' }}" name="ic_no">
                        @else
                            <input type="text" id="ic_no" class="form-control" placeholder="" value="{{ $user->parents->ic_no ?? '' }}" name="ic_no">
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
            <div class="col-12">
                <div class="form-group row">
                    <div class="col-12 pl-1 text-center">
                        {{-- <button type="submit" class="btn btn-primary me-3 px-2 py-2" title="Terima Permohonan"> 
                            Kemaskini Profil
                        </button> --}}
                        <button type="button" class="btn btn-primary me-3 px-2 py-2" title="Terima Permohonan" onclick="update_profile({{ $user->id }})"> 
                            Kemaskini Profil
                        </button>
                    </div>
                </div>
            </div>
        </div>
        {{-- </form> --}}
    </div>
</div>

@endsection

@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">

    function update_profile(id){

        var phoneNo = $('#phone_no').val();
        var ic_no = $('#ic_no').val();
        var staff_no = $('#staff_no').val();
        var password = $('#password').val();
        var job = $('#job').val();

        console.log(phoneNo);
        console.log(ic_no);
        console.log(id);

        $.ajax({
            type: "POST",
            url: "{{ route('pengguna.kemaskini_profil') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "user_id": id,
                "job" : job,
                "phone_no": phoneNo,
                "ic_no": ic_no,
                "staff_no": staff_no,
                "password": password,
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