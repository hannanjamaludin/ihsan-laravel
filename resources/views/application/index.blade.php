@extends('layouts.auth-app')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="col-12 d-flex justify-content-end mb-4">
            <a href="{{ route('pendaftaran.pendaftaranBaru') }}" class="btn btn-primary me-3">
                <i class="fa fa-plus"></i> Pendaftaran Baharu
            </a>
        </div>

        <div class="card mb-4 mx-3">
            <div class="card-header py-1 d-flex flex-row justify-content-between card-header-divider">
                <div class="col">
                    <h5 class="card-title mt-2">Status Pendaftaran</h5>
                </div>
            </div>

            {{-- put if else for this part --}}

            {{-- <div class="" id="child">
                <div class="card-body px-3 pt-2 pb-4 w-auto">
                    <div class="mt-3 text-center">
                        Tiada pendaftaran dihantar
                    </div>
                </div>
            </div> --}}

            <div class="" id="child">
                <div class="card-body px-3 py-2 w-auto">
                    <div class="mt-3 text-start">
                        <div class="card mb-4 mx-3 card-students">
                            <div class="card-body px-3 py-2 w-auto">
                                <div class="row">
                                    <div class="col-2 text-center">
                                        <div class="rounded-circle mx-auto bg-secondary shadow-lg" style="width: 75px; height: 75px; display: flex; justify-content: center; align-items: center;">
                                            <i class="fas fa-user" style="font-size: 40px;"></i>
                                        </div>
                                    </div>
                                    <div class="col-10 pt-2">
                                        <div class="container d-flex align-items-center justify-content-between m-0 p-0">
                                            <h5 class="card-title text-primary">Lisa Sofea binti Mohammad Aqeel</h5> 
                                            <button type="button" class="btn-close" aria-label="Tutup"></button>   
                                        </div>
                                        <div class="container d-flex align-items-center justify-content-start m-0 p-0">
                                            <div class="card-subtitle text-muted">21/03/24</div>                                                    
                                            <div class="badge bg-warning ms-3" style="background-color: var(--custom-warning-color);">Dihantar</div>
                                        </div>                                             
                                    </div>
                                </div>     
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.btn-close').forEach(button => {
            button.addEventListener('click', function () {
                Swal.fire({
                    title: "Buang Pendaftaran?",
                    text: "Adakah anda pasti untuk membuang pendaftaran Lisa Sofea?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#703232",
                    cancelButtonColor: "#BABABA",
                    confirmButtonText: "Ya, saya pasti",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Pendaftaran Dibuang",
                            text: "Pendaftaran Lisa Sofea telah dibuang",
                            icon: "success",
                            confirmButtonColor: '#703232'
                        });
                    }
                });
            });
        });
    });

</script>
@endsection
