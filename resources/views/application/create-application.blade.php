@extends('layouts.auth-app')
@section('content')

<div class="row">
    <div class="col-12">
        <form method="POST" action="{{ route('pendaftaran.store_application_session') }}">
            @csrf 
            {{-- Maklumat Anak --}}
            <livewire:application.child-information />

            {{-- Maklumat Ibu --}}
            <livewire:application.mother-information />

            {{-- Maklumat Bapa --}}
            <livewire:application.father-information />

            <div class="col-12 d-flex justify-content-end mb-4">
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-kembali me-3">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary btn-kembali me-3">
                    Seterusnya <i class="fa fa-arrow-right"></i>
                </button>
            </div>
        </form>

    </div>
</div>

@endsection

@section('js')
<script>

window.addEventListener('displayMomStaff', event => {
    $('#utmStudent_mom').addClass('d-none');
    $('#utmStaff_mom').removeClass('d-none');
});

window.addEventListener('displayMomStudent', event => {
    $('#utmStaff_mom').addClass('d-none');
    $('#utmStudent_mom').removeClass('d-none');
});

window.addEventListener('displayDadStaff', event => {
    $('#utmStudent_dad').addClass('d-none');
    $('#utmStaff_dad').removeClass('d-none');
});

window.addEventListener('displayDadStudent', event => {
    $('#utmStaff_dad').addClass('d-none');
    $('#utmStudent_dad').removeClass('d-none');
});

window.addEventListener('hideInputBox', event => {
    $('#utmStaff_mom').addClass('d-none');
    $('#utmStudent_mom').addClass('d-none');
});

window.addEventListener('hideInputBoxDad', event => {
    $('#utmStaff_dad').addClass('d-none');
    $('#utmStudent_dad').addClass('d-none');
});

</script>
@endsection