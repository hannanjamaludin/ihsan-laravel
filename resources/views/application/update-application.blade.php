@extends('layouts.auth-app')
@section('content')

<div class="row">
    <div class="col-12">

        <div class="card mb-4 mx-3">
            <div class="card-header bg-primary">
                <div class="card-title text-light">Pendaftaran Baharu</div>
            </div>

            {{-- <div class="card-body px-3 pt-2 pb-4 w-auto">
                <div class="mt-3 text-center text-primary">
                    Tiada Pendaftaran Baharu
                </div>
            </div> --}}
            
            <div class="card-body px-3 pt-2 pb-4 w-auto">
                <div class="mt-3 text-center text-primary">
                    <livewire:application.view-application />
                </div>
            </div>

            {{-- <div class="row mt-3">
                <div class="col-4">
                    <div class="card mb-4 mx-3 card-students">
            
                        <div class="card-body px-3 py-4 w-auto">
                            <div class="mt-3 text-center text-primary">                                
                                <div class="rounded-circle mx-auto mb-3 bg-secondary shadow-lg" style="width: 100px; height: 100px; display: flex; justify-content: center; align-items: center;">
                                    <i class="fas fa-user" style="font-size: 50px;"></i>
                                </div>
                                <h5 class="card-title text-primary">Lisa Sofea binti Mohammad Aqeel</h5>
                                <div class="card-text">4 Tahun</div>
                                <div class="card-text">Tadika Ihsan</div>
                                <div class="badge bg-warning mt-3" style="background-color: var(--custom-warning-color);">UTM Staff</div>
                                <ul class="nav nav-pills justify-content-center mt-3">
                                    <li class="nav-item">
                                        <button type="button" class="btn btn-info rounded-circle me-3 px-3" style="background-color: var(--custom-info-color); border:none" title="Maklumat murid"><i class="fas fa-info text-light"></i></button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" class="btn btn-success rounded-circle me-3" style="background-color: var(--custom-success-color); border:none" title="Terima Permohonan"><i class="fas fa-check"></i></button>
                                    </li>
                                    <li class="nav-item">
                                        <button type="button" class="btn btn-danger rounded-circle" style="background-color: var(--custom-danger-color); border:none" title="Tolak permohonan"><i class="fas fa-times"></i></button>
                                    </li>
                                </ul>
                            </div>
                        </div>
            
                    </div>
                </div>
            </div> --}}

        </div>

    </div>
</div>

@endsection
