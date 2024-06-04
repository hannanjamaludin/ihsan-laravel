<div>
    <div class="row">
        <div class="col-md-6">
            {{-- Application section --}}
            <div class="custom-container" id="students-container">
                @foreach ($students as $s)
                    <div class="card mb-2">
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
                                        @if ($s->applicationStatus->status != 1)
                                            <button id="" type="button" class="btn-close" aria-label="Tutup" data-student-id="{{ $s->id }}"></button>   
                                        @endif
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

        {{-- Student Section --}}
        <div class="col-md-6">
            <div class="custom-container">
                <div class="">
                    <!-- Your content here -->
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Custom CSS --}}
<style>
    .custom-container {
        border-radius: 15px;
        background-color: #eaeaeae7;
        padding: 15px;
        margin-bottom: 20px;
        position: relative;
    }

    #students-container::before {
        content: "";
        position: absolute;
        top: 145px; 
        left: -40px; 
        width: 0;
        height: 0;
        border-left: 20px solid transparent;
        border-right: 20px solid #eaeaeae7; 
        border-top: 20px solid transparent;
        border-bottom: 20px solid transparent;
    }
</style>
