<div>
    {{-- TO BE UPDATED(UI) --}}
    {{-- <p>{{ count($presentStudents) }}/{{ $class->total_students }} kehadiran</p> --}}
    {{-- TO BE UPDATED(UI) --}}

    <div class="row">
        <div class="col-12">
            @foreach ($students as $s)
                <div class="card mb-2">
                    <div class="card-body px-3 py-2 d-flex justify-content-between align-items-center">
                        <h5 class="">{{ $s->full_name }}</h5> 
                        <div>
                            <button class="btn btn-primary btn-circle me-2" wire:click="markPresent({{ $s->id }})">
                                <i class="fas fa-check"></i>
                            </button>
                            <button class="btn btn-secondary btn-circle" wire:click="markAbsent({{ $s->id }})">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-6 mt-4">
            <div class="card mb-4">
                <div class="card-header py-1 bg-primary text-light">
                    <div class="col d-flex justify-content-between align-items-end">
                        <h3 class="card-title mt-2">
                            <i class="fas fa-check"></i>
                            Hadir
                        </h3>
                        <span class="card-title fs-6 fw-light text ms-2 fst-italic">{{ count($presentStudents) }} murid</span>
                    </div>
                </div>
                <div class="card-body px-3 pt-2 pb-4 w-auto">
                    @if (count($presentStudents) > 0)
                    {{-- @php
                        dd($presentStudents);
                    @endphp --}}
                        @foreach ($presentStudents as $key => $s)
                            <div class="d-flex align-items-center mb-1">
                                <div class="text-primary me-2">{{ $key + 1 }}.</div>
                                <div class="card bg-primary">
                                    <div class="card-body py-1">
                                        <div class="text-light">{{ $s->student->full_name }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="mt-3 text-center">
                            Tiada kehadiran
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-4">
            <div class="card mb-4">
                <div class="card-header py-1 bg-secondary text-light">
                    <div class="col d-flex justify-content-between align-items-end">
                        <h3 class="card-title mt-2">
                            <i class="fas fa-times"></i>
                            Tidak Hadir
                        </h3>
                        <span class="card-title fs-6 fw-light text ms-2 fst-italic">{{ count($absentStudents) }} murid</span>
                    </div>
                </div>
                <div class="card-body px-3 pt-2 pb-4 w-auto">
                    @if (count($absentStudents) > 0)
                    {{-- @php
                        dd($absentStudents);
                    @endphp --}}
                        @foreach ($absentStudents as $key => $s)
                            <div class="d-flex align-items-center mb-1">
                                <div class="text-secondary me-2">{{ $key + 1 }}.</div>
                                <div class="card bg-secondary">
                                    <div class="card-body py-1">
                                        <div class="text-light">{{ $s->student->full_name }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="mt-3 text-center">
                            Tiada kehadiran
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-circle {
        width: 40px;
        height: 40px;
        padding: 6px 0;
        border-radius: 50%;
        text-align: center;
        font-size: 20px;
        line-height: 1.42857;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
