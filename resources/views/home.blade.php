@extends('layouts.auth-app')

@section('content')

    @if ($user->user_type == 1)
        <livewire:home.admin-home-page/>
    @elseif ($user->user_type == 2)
        <livewire:home.staff-home-page/>
    @else
        <livewire:home.parent-home-page/>
    @endif

@endsection
