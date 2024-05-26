@extends('layouts.auth-app')
@section('content')

<div class="row mt-3 mx-2">
    <div class="col-12">
        <livewire:student.student-attendance :class="$class" :today="$today" :branch="$branch" />
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