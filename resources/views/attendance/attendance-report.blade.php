@extends('layouts.auth-app')
@section('content')

<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mx-3">
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('kehadiran.rekod_kehadiran') }}" class="text-primary" style="text-decoration: none">Rekod Kehadiran</a></li>
                {{-- <li class="breadcrumb-item active" aria-current="page">{{ $class->age }} {{ $class->class_name }}</li> --}}
            </ol>
        </nav>

        <div class="card mb-4 mx-3">
            <div class="card-header py-1 d-flex flex-row justify-content-between card-header-divider">
                <div class="col">
                    <h5 class="card-title mt-2">Rekod Kehadiran {{ $branch->branch_name }}</h5>
                </div>
            </div>

            <div class="" id="child">
                <div class="card-body px-3 py-4 w-auto">
                    <div class="mt-3 text-start">

                        @php
                            $icons = [
                                'fa-robot',
                                'fa-puzzle-piece',
                                'fa-cookie-bite',
                                'fa-shapes',
                                'fa-cubes-stacked',
                            ];
                        @endphp
        
                        @foreach ($classes as $index => $class)
                            @php
                                $attendancePercentage = $attendancePercentages[$class->id] ?? 0;
                                $present = $classAttendance[$class->id]['present'] ?? 0;
                                $total = $classAttendance[$class->id]['total'] ?? 0;
                            @endphp 
                            <div class="card mb-4 mx-3 card-students clickable-card" style="cursor: pointer;"
                                    data-href="{{ route('kehadiran.rekod_kehadiran_detail', ['classId' => $class->id]) }}">
                                <div class="card-body px-3 py-2 w-auto">
                                    <div class="row">
                                        <div class="col-1 d-flex align-items-center justify-content-end">
                                            <i class="fa {{ $icons[$index % count($icons)] }} text-primary" style="font-size: 40px;"></i>
                                        </div>
                                        <div class="col-2 text-center mx-0 px-0">
                                            <div class="mx-0">
                                                @if ($branch->id == 1)
                                                    <h5 class="card-title text-primary">{{ $class->class_name }}</h5>
                                                @else
                                                    <h4 class="card-title text-primary mb-0 py-0">{{ $class->age }}</h4>
                                                    <h5 class="card-title text-primary mt-0">{{ $class->class_name }}</h5>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="pt-2">
                                                <div class="text-muted">{{ $today }}</div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="progress" style="width: 95%">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $attendancePercentage }}%" aria-valuenow="{{ $attendancePercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div>
                                                        <div class="text-muted">{{ $present }}/{{ $total }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <div class="container d-flex align-items-center justify-content-end m-0 pt-1">
                                                <a 
                                                {{-- href="{{ route('pembayaran.yuran_student', ['studentId' => $s->id]) }}"  --}}
                                                class="btn btn-link text-decoration-none" style="font-size: 24px;">
                                                    <i class="fas fa-chevron-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>     
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('js')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const clickableCards = document.querySelectorAll('.clickable-card');
        clickableCards.forEach(card => {
            card.addEventListener('click', function() {
                const href = this.getAttribute('data-href');
                if (href) {
                    window.location.href = href;
                }
            });
        });
    });
</script>

@endsection