<div>
    <div class="row">

        {{-- Profile section --}}
        <div class="col-md-12 mt-1 mb-4">
            <div class="card">
                <div class="card-body ps-3 pe-1">
                    <div class="row">
                        <div class="col-md-2 d-flex text-center align-items-center">
                            <div class="rounded-circle mx-auto shadow-lg bg-secondary" style="width: 140px; height: 140px; display: flex; justify-content: center; align-items: center;">
                                <i class="fas fa-user" style="font-size: 70px;"></i>
                            </div>
                        </div>
                        <div class="col-md-10 ps-4">
                            <div class="row mb-2">
                                <div class="col-10">
                                    <h4 class="text-primary">{{ $user->parents->full_name }}</h4>
                                </div>
                                <div class="col-2">
                                    <div class="text-end me-3">
                                        <a href="{{ route("pengguna.index") }}" class="text-primary fw-light fs-6 text" style="text-decoration: none">Kemaskini</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-auto d-flex align-items-center">
                                    <div class="rounded-circle bg-light" style="display: flex; justify-content: center; align-items: center; width: 30px; height: 30px; border: 1px solid #BABABA;">
                                        <i class="fa fa-clipboard-user" style="font-size: 16px;"></i>
                                    </div>
                                </div>
                                <div class="col-4 d-flex align-items-center">
                                    <div class="text-start">{{ $user->staff_no }}</div>
                                </div>
                                <div class="col-auto d-flex align-items-center">
                                    <div class="rounded-circle bg-light" style="display: flex; justify-content: center; align-items: center; width: 30px; height: 30px; border: 1px solid #BABABA;">
                                        <i class="fa fa-id-card" style="font-size: 16px;"></i>
                                    </div>
                                </div>
                                <div class="col-4 d-flex align-items-center">
                                    <div class="text-start">{{ $user->parents->ic_no ?? '-' }}</div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-auto d-flex align-items-center">
                                    <div class="rounded-circle bg-light" style="display: flex; justify-content: center; align-items: center; width: 30px; height: 30px; border: 1px solid #BABABA;">
                                        <i class="fa fa-phone" style="font-size: 16px;"></i>
                                    </div>
                                </div>
                                <div class="col-4 d-flex align-items-center">
                                    <div class="text-start">{{ $user->parents->phone_no }}</div>
                                </div>
                                <div class="col-auto d-flex align-items-center">
                                    <div class="rounded-circle bg-light" style="display: flex; justify-content: center; align-items: center; width: 30px; height: 30px; border: 1px solid #BABABA;">
                                        <i class="fa fa-children" style="font-size: 16px;"></i>
                                    </div>
                                </div>
                                <div class="col-4 d-flex align-items-center">
                                    <div class="text-start">{{ $children->count() }} anak</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Application Updates Section -->
        <div class="col-md-6">
            <div class="custom-container" style="height: 383px;">
                <h4 class="mb-4">Permohonan Pendaftaran</h4>
                @if ($students->isNotEmpty())
                    @foreach ($students as $s)
                        <div class="card mb-3" style="background-color: #f2f1f1e7">
                            <div class="card-body ps-3 pe-1">
                                <div class="row">
                                    <div class="col-2 text-center">
                                        @if ($s->gender == 'lelaki')
                                            <div class="rounded-circle mx-auto shadow-lg" style="background-color: #bcd2e9; width: 50px; height: 50px; display: flex; justify-content: center; align-items: center;">
                                                <i class="fas fa-child" style="font-size: 30px;"></i>
                                            </div>
                                        @else
                                            <div class="rounded-circle mx-auto shadow-lg" style="background-color: #dac6dd; width: 50px; height: 50px; display: flex; justify-content: center; align-items: center;">
                                                <i class="fas fa-child-dress" style="font-size: 30px;"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-10">
                                        <div class="container d-flex align-items-center justify-content-between m-0 p-0">
                                            <h5 class="card-title text-primary">{{ $s->full_name }}</h5> 
                                        </div>
                                        <div class="container d-flex align-items-center justify-content-start m-0 p-0">
                                            <div class="card-subtitle text-muted">{{ $s->applicationStatus->updated_at }}</div>   
                                            @if ($s->applicationStatus->status === 0)
                                                <div class="badge ms-3" style="background-color: #D4AFB9;">Ditolak</div>
                                            @elseif ($s->applicationStatus->status === 1)
                                                <div class="badge ms-3" style="background-color: #a6b6a4;">Diterima</div>
                                            @elseif ($s->applicationStatus->status === null)
                                                <div class="badge bg-secondary ms-3" style="background-color: var(--custom-secondary-color);">Dihantar</div>
                                            @endif                                                 
                                        </div>                                             
                                    </div>
                                </div>     
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="d-flex flex-column justify-content-center align-items-center mt-5 pt-5 text-muted">
                        Tiada pendaftaran dihantar
                        <a href="{{ route('pendaftaran.pendaftaranBaru') }}" class="btn btn-primary mt-2">
                            <i class="fa fa-plus"></i> Pendaftaran Baharu
                        </a>
                    </div>
                @endif
            </div>
        </div>

        {{-- Payment section --}}
        @if ($children->isNotEmpty())
            <div class="col-md-6">
                <div class="custom-container" style="">
                    <h4 class="mb-4">Pembayaran Yuran Bulan {{ $month->month }}</h4>
                    <table class="table table-bordered">
                        <thead style="background-color: #f2f1f1e7">
                            <tr>
                                <th style="white-space: nowrap;">Nama Anak</th>
                                <th style="white-space: nowrap;">Cawangan</th>
                                <th style="white-space: nowrap;">Jumlah</th>
                                <th style="white-space: nowrap;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($children as $child)
                                <tr>
                                    <td>{{ $child->full_name }}</td>
                                    <td>{{ $child->branch->branch_name }}</td>
                                    <td>
                                        @if ($child->assignedClass)
                                            RM {{ $child->assignedClass->fee }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($child->assignedClass)
                                            @if (isset($payments[$child->id]) && $payments[$child->id] !== null)
                                                <i class="fas fa-check text-success"></i>
                                            @else
                                                <i class="fas fa-xmark text-danger"></i>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    
    </div>
</div>

<style>
    .custom-container {
        border-radius: 15px;
        background-color: white;
        padding: 15px;
        margin-bottom: 20px;
        position: relative;
        height: auto;
        display: flex;
        flex-direction: column;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

</style>