@extends('layouts.auth-app')
@section('content')

<div class="row">
    
    <div class="col-12 mx-1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mx-3">
                <li class="breadcrumb-item"><a href="{{ route('murid.profile') }}" class="text-primary" style="text-decoration: none">Profil Anak</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $student->full_name }}</li>
            </ol>
        </nav>

        <div class="card mb-4 mx-3">
            <div class="card-header py-1 bg-primary text-light d-flex flex-row justify-content-between card-header-divider">
                <div class="col">
                    <h5 class="card-title mt-2">Maklumat {{ $student->full_name }}</h5>
                </div>
                <div class="col-auto">
                    <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#child" aria-expanded="true" title="Collapse">
                        <i class="fas fa-chevron-down text-light"></i>
                    </button>
                </div>
            </div>

            <div class="collapse multi-collapse show" id="child">
                <div class="card-body px-3 pt-2 pb-4 w-auto">
                    
                    <form id="studentForm" method="POST" action="{{ route('murid.kemaskini_profil', $student->id) }}">
                        @csrf

                        <div class="form-group row">
                            <div class="col-12 pl-1">
                                <label class="form-label" for="full_name">Nama Penuh</label>
                                <input type="text" id="full_name" class="form-control" value="{{ $student->full_name }}" required name="full_name" disabled>
                            </div>
                        </div>
                        
                        <div class="form-group row mt-4">
                            <div class="col-4 pl-1">
                                <label class="form-label" for="ic_no">No. MyKid</label>                        
                                <input type="text" id="ic_no" class="form-control" value="{{ $student->ic_no }}" required name="ic_no" disabled>
                            </div>
                            <div class="col-4 pl-1">
                                <label class="form-label" for="dob">Tarikh Lahir</label>                        
                                <input type="date" id="dob" class="form-control" value="{{ $student->dob }}" required name="dob" disabled>
                            </div>
                            <div class="col-4 pl-1">
                                <label class="form-label" for="gender">Jantina</label>                        
                                <input type="text" id="gender" class="form-control" value="{{ $student->gender }}" required name="gender" disabled>
                            </div>
                        </div>
                        
                        <div class="form-group row mt-4">
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Adik-beradik (Anak ke Berapa)</label>                            
                                    <input type="text" id="siblings" class="form-control" value="{{ $student->siblings }}" required name="siblings" disabled>
                                </div>
                            </div>
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Alahan</label>                            
                                    <input type="text" id="allergy" class="form-control" value="{{ $student->allergy }}" name="allergy" disabled>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row mt-4">
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Kelainan Upaya</label>                            
                                    <input type="text" id="disability" class="form-control" value="{{ $student->disability }}" name="disability" disabled>
                                </div>
                            </div>
                            <div class="col-6 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Penyakit Kronik</label>                            
                                    <input type="text" id="illness" class="form-control" value="{{ $student->illness }}" name="illness" disabled>                                
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row mt-4">
                            <div class="col-12 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Masalah Kesihatan & Pembelajaran</label>                            
                                    <input type="text" id="study" class="form-control" value="{{ $student->study }}" name="study" disabled>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row mt-4">
                            <div class="col-12 pl-1">
                                <div class="form-group">
                                    <label class="form-label">Alamat Rumah</label>
                                    <input type="text" id="address1" class="form-control" value="{{ $student->address1 }}" required name="address1" disabled>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row mt-1">
                            <div class="col-4 pl-1">
                                <div class="form-group">
                                    <input type="text" id="state" class="form-control" value="{{ $student->state }}" required name="state" disabled>
                                </div>
                            </div>
                            <div class="col-4 pl-1">
                                <div class="form-group">
                                    <input type="text" id="district" class="form-control" value="{{ $student->district }}" required name="district" disabled>
                                </div>
                            </div>
                            <div class="col-4 pl-1">
                                <div class="form-group">
                                    <input type="text" id="postcode" class="form-control" value="{{ $student->postcode }}" required name="postcode" disabled>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row mt-4">
                            <div class="col-4 pl-1">
                                <label class="form-label">Pakej</label>
                                <input type="text" id="branch_id" class="form-control" value="{{ $student->branch->branch_name }}" required name="branch_id" disabled>
                            </div>
                            <div class="col-4 pl-1"></div>
                            <div class="col-4 d-flex justify-content-end align-items-end">
                                <button type="button" class="btn btn-primary ms-3 px-2 py-2" id="editButton" onclick="enableEdit()">Kemaskini</button>
                                <button type="submit" class="btn btn-primary ms-3 px-2 py-2" id="submitButton" style="display: none;">Hantar</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
                                    
    </div>
    
</div>
@endsection

@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function enableEdit() {
        var inputs = document.querySelectorAll('#studentForm input');
        inputs.forEach(function(input) {
            input.disabled = false;
        });
        document.getElementById('editButton').style.display = 'none';
        document.getElementById('submitButton').style.display = 'inline-block';
    }

    document.getElementById('studentForm').addEventListener('submit', function(event) {
        event.preventDefault(); 

        var formData = new FormData(this);

        var xhr = new XMLHttpRequest();

        xhr.open('POST', this.action);
        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berjaya!',
                    text: 'Profil telah dikemaskini.',
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Profil tidak dapat dikemaskini.',
                });
            }
        };

        xhr.onerror = function() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Profil tidak dapat dikemaskini.',
            });
        };

        xhr.send(formData);
    });
</script>

@endsection
