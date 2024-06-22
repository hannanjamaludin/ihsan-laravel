@extends('layouts.auth-app')
@section('content')

<div class="row mt-1 mx-2">
    <div class="col-12">
        @if ($teacher->branch_id == 1)
            <livewire:student.student-taska-activity :room="$class" :today="$today" />
        @else
            <livewire:student.student-tadika-activity :class="$class" :today="$today" />
        @endif
    </div>
</div>
@endsection

@section('css')
<style>
    th {
        width: 15% !important;
    }
</style>
@endsection