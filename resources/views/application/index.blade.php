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

            @if ($student->isEmpty())
                <div class="" id="child">
                    <div class="card-body px-3 pt-2 pb-4 w-auto">
                        <div class="mt-3 text-center">
                            Tiada pendaftaran dihantar
                        </div>
                    </div>
                </div>
            @else                
                <div class="" id="child">
                    <div class="card-body px-3 py-4 w-auto">
                        <div class="mt-3 text-start">
                            @foreach ($student as $s)
                                    <div class="card mb-2 mx-3 card-students">
                                        <div class="card-body px-3 py-2 w-auto">
                                            <div class="row">
                                                <div class="col-2 text-center">
                                                    <div class="rounded-circle mx-auto bg-secondary shadow-lg" style="width: 75px; height: 75px; display: flex; justify-content: center; align-items: center;">
                                                        <i class="fas fa-user" style="font-size: 40px;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-10 pt-2">
                                                    <div class="container d-flex align-items-center justify-content-between m-0 p-0">
                                                        <h5 class="card-title text-primary">{{ $s->full_name }}</h5> 
                                                        <button id="remove_application" type="button" class="btn-close" aria-label="Tutup" data-student-id="{{ $s->id }}"></button>   
                                                    </div>
                                                    <div class="container d-flex align-items-center justify-content-start m-0 p-0">
                                                        <div class="card-subtitle text-muted">{{ $s->applicationStatus->updated_at }}</div>   
                                                        @if ($s->applicationStatus->status === 0)
                                                            <div class="badge bg-danger ms-3" style="background-color: var(--custom-danger-color);">Ditolak</div>
                                                        @elseif ($s->applicationStatus->status === 1)
                                                            <div class="badge bg-success ms-3" style="background-color: var(--custom-success-color);">Diterima</div>
                                                        @elseif ($s->applicationStatus->status === null)
                                                            <div class="badge bg-secondary ms-3" style="background-color: var(--custom-secondary-color);">Dihantar</div>
                                                        @endif                                                 
                                                    </div>                                             
                                                </div>
                                            </div>     
                                        </div>
                                    </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    $('.btn-close').on('click', function() {
        var studentId = $(this).data('student-id');
        var studentName = $(this).closest('.card-students').find('.card-title').text().trim();

        Swal.fire({
            title: "Buang Pendaftaran?",
            text: "Adakah anda pasti untuk membuang pendaftaran " + studentName + "?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#703232",
            cancelButtonColor: "#BABABA",
            confirmButtonText: "Ya, saya pasti",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('pendaftaran.buang_permohonan') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": studentId,
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: "Pendaftaran Dibuang",
                                text: "Pendaftaran telah dibuang",
                                icon: "success",
                                confirmButtonColor: '#703232'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: "Ralat",
                                text: "Pendaftaran gagal dibuang",
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
                        });
                    }

                })
            }
        });
          

    })

</script>
@endsection
