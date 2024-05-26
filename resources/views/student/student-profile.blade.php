@extends('layouts.auth-app')
@section('content')

<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mx-3">
                <li class="breadcrumb-item active"><a href="{{ route('murid.profile') }}" class="text-primary" style="text-decoration: none">Profil Anak</a></li>
            </ol>
        </nav>
        
        <div class="card mb-4 mx-3">
            <div class="card-header py-1 d-flex flex-row justify-content-between card-header-divider">
                <div class="col">
                    <h5 class="card-title mt-2">Profil Anak</h5>
                </div>
            </div>

            <div class="" id="child">
                <div class="card-body px-3 py-4 w-auto">
                    <div class="mt-3 text-start">
                        @foreach ($students as $s)
                                <div class="card mb-4 mx-3 card-students clickable-card" style="cursor: pointer;" 
                                        data-href="{{ route('murid.detail', ['studentId' => $s->id]) }}">
                                    <div class="card-body px-3 py-2 w-auto">
                                        <div class="row">
                                            <div class="col-2 text-center">
                                                <div class="rounded-circle mx-auto bg-secondary shadow-lg" style="width: 75px; height: 75px; display: flex; justify-content: center; align-items: center;">
                                                    <i class="fas fa-user" style="font-size: 40px;"></i>
                                                </div>
                                            </div>
                                            <div class="col-8 pt-2">
                                                <div class="container d-flex align-items-center justify-content-between m-0 p-0">
                                                    <h5 class="card-title text-primary">{{ $s->full_name }}</h5> 
                                                </div>
                                                <div class="container d-flex align-items-center justify-content-start m-0 p-0">
                                                    <div class="card-subtitle text-muted">{{ $s->branch->branch_name }}</div>   
                                                </div>                                             
                                            </div>
                                            <div class="col-2 pt-2">
                                                <div class="container d-flex align-items-center justify-content-end m-0 pt-1">
                                                    <a href="#" class="btn btn-link text-decoration-none" style="font-size: 24px;">
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