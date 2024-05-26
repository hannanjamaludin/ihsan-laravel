@extends('layouts.auth-app')
@section('content')

<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mx-3">
                <li class="breadcrumb-item"><a href="{{ route('kehadiran.rekod_kehadiran') }}" class="text-primary" style="text-decoration: none">Rekod Kehadiran</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $class->age }} {{ $class->class_name }}</li>
            </ol>
        </nav>

        @foreach ($months as $key => $month)
            @php
                $monthKey = Carbon\Carbon::create()->year(now()->year)->month($month->id)->format('Y-m');
                $daysInMonth = Carbon\Carbon::create()->month($month->id)->daysInMonth;
            @endphp

            <div class="card mb-1 mx-3">
                <div class="card-header py-1 d-flex flex-row justify-content-between card-header-divider bg-secondary">
                    <div class="col">
                        <h5 class="card-title mt-2" style="color: black">{{ $month->month }}</h5>
                    </div>
                    <div class="col-auto">
                        <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#attendance-{{ $key }}" aria-expanded="false" title="Collapse">
                            <i class="fas fa-chevron-down" style="color: black"></i>
                        </button>
                    </div>
                </div>

                <div class="collapse multi-collapse" id="attendance-{{ $key }}">
                    <div class="card-body py-2 px-0 w-auto" style="background-color: #EAEAEA; overflow-x: auto;">
                        <div class="col-12 pl-1">
                            <div style="overflow-x: auto;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="white-space: nowrap;">Murid</th>
                                            @for ($d = 1; $d <= $daysInMonth; $d++)
                                                <th style="width: 10%">{{ str_pad($d, 2, '0', STR_PAD_LEFT) }}</th>
                                            @endfor
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($attendanceRecords[$monthKey]))
                                            @foreach ($attendanceRecords[$monthKey]->groupBy('student_id') as $studentId => $records)
                                                <tr>
                                                    <td style="white-space: nowrap;">{{ $records->first()->student->full_name }}</td>
                                                    @php
                                                        $attendanceByDate = $records->keyBy('date');
                                                    @endphp
                                                    @for ($d = 1; $d <= $daysInMonth; $d++)
                                                        @php
                                                            $date = Carbon\Carbon::create()->year(now()->year)->month($month->id)->day($d)->format('Y-m-d');
                                                        @endphp
                                                        @if (isset($attendanceByDate[$date]))
                                                            @if ($attendanceByDate[$date]->status == true)
                                                                <td><i class="fas fa-check text-success"></i></td>
                                                            @elseif ($attendanceByDate[$date]->status == false)
                                                                <td><i class="fas fa-xmark text-danger"></i></td>
                                                            @endif
                                                        @else
                                                            <td> </td>
                                                        @endif
                                                    @endfor
                                                </tr>
                                            @endforeach
                                        @else
                                            @foreach ($students as $student)
                                                <tr>
                                                    <td style="white-space: nowrap;">{{ $student->full_name }}</td>
                                                    @for ($d = 1; $d <= $daysInMonth; $d++)
                                                        <td> </td>
                                                    @endfor
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
