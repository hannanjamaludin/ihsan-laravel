@extends('layouts.auth-app')
@section('content')

<div class="row mt-1 mx-2">
    <div class="col-12">
        @if ($teacher->branch_id == 1)
            <livewire:student.student-taska-activity />
        @else
            <livewire:student.student-tadika-activity :class="$class" :today="$today" />
        @endif
    </div>
</div>
@endsection

{{-- @section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Livewire.on('formSubmitted', () => {
        console.log('Submitted');
        Swal.fire({
            title: 'Success!',
            text: 'Form submitted successfully.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    });
</script>
@endsection --}}

@section('css')
<style>
    th {
        width: 15% !important;
    }
</style>
@endsection