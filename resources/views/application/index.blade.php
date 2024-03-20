@extends('layouts.auth-app')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="col-12 d-flex justify-content-end mb-4">
            <a href="{{ route('pendaftaran.pendaftaranBaru') }}" class="btn btn-primary me-3">
                <i class="fa fa-plus"></i> Pendaftaran Baru
            </a>
        </div>

        <div class="card mb-4 mx-3">

            <div class="collapse multi-collapse show" id="child">
                <div class="card-body px-3 pt-2 pb-4 w-auto">
                    <div class="mt-3 text-center">
                        Still Coding...
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
