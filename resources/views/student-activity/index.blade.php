@extends('layouts.auth-app')
@section('content')

<div class="row mt-3 mx-2">
    <div class="col-12">
        <div class="d-flex align-items-center">
            @if ($branch->id == 1)
                <h3 class="text-primary">{{ $class->class_name }}</h3>
            @else
                <h3 class="text-primary">{{ $class->age }} {{ $class->class_name }}</h3>
                <div class="badge bg-warning ms-3" style="background-color: var(--custom-warning-color);">
                    {{ $class->total_students }} Murid
                </div>
            @endif
        </div>
        <p>Kehadiran {{ $today }}</p>
        <livewire:student.student-attendance :class="$class" :today="$today" />
    </div>
</div>

@endsection
