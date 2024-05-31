@extends('layouts.auth-app')
@section('content')

<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mx-3">
                <li class="breadcrumb-item active"><a href="{{ route('pembayaran.index') }}" class="text-primary" style="text-decoration: none">Pembayaran</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $name }}</li>
            </ol>
        </nav>

        @if (is_null($class))
            <div class="card mb-1 mx-3">
                <div class="card-body px-3 pt-2 pb-4 w-auto" style="background-color: #EAEAEA">
                    <div class="mt-3 text-center">
                        Yuran masih belum tersedia
                    </div>
                </div>
            </div>
        @else
            @foreach ($years as $y)
            <div class="card mb-1 mx-3">
                <div class="card-header py-1 d-flex flex-row justify-content-between card-header-divider bg-primary">
                    <div class="col">
                        <h5 class="card-title mt-2 text-light">{{ $y }}</h5>
                    </div>
                    <div class="col-auto">
                        <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#year{{ $y }}" aria-expanded="false" title="Collapse">
                            <i class="fas fa-chevron-down text-light"></i>
                        </button>
                    </div>
                </div>
                
                <div class="collapse multi-collapse" id="year{{ $y }}">
                    <div class="card-body py-2 px-0 w-auto" style="background-color: #EAEAEA">
                        <div class="col-12 pl-1">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="ps-4 py-1">
                                    <h5>Bulan</h5>
                                </div>
                                <div class="me-5 pe-5"><h5>Status</h5></div>
                            </div>
                        </div>
                        @foreach ($months as $key => $month)
                            <div class="card mb-1 mx-3">
                                @if(isset($paymentMonthsYears[$y][$month->id]))
                                    <div class="card-header py-1 d-flex flex-row justify-content-between card-header-divider bg-secondary">
                                        <div class="col">
                                            <h5 class="card-title mt-2" style="color: black">{{ $month->month }}</h5>
                                        </div>
                                        <div class="col-auto">
                                            <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#payment{{ $y }}-{{ $key }}" aria-expanded="false" title="Collapse">
                                                <i class="fas fa-chevron-down" style="color: black"></i>
                                            </button>
                                        </div>
                                    </div>
                                @else
                                    <div class="card-header py-1 d-flex flex-row justify-content-between card-header-divider bg-light">
                                        <div class="col">
                                            <h5 class="card-title mt-2 text-primary">{{ $month->month }}</h5>
                                        </div>
                                        <div class="col-auto">
                                            <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#payment{{ $y }}-{{ $key }}" aria-expanded="false" title="Collapse">
                                                <i class="fas fa-chevron-down text-primary"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                
                                
                                <div class="collapse multi-collapse" id="payment{{ $y }}-{{ $key }}">
                                    <div class="card-body py-2 px-0 w-auto" style="background-color: #EAEAEA">
                                        @if(isset($paymentMonthsYears[$y][$month->id]))
                                            <div class="col-12 pl-1">
                                                <table id="paid_table" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 60%">Rujukan</th>
                                                            <th style="width: 10%">Amaun</th>
                                                            <th style="width: 17%">Tarikh</th>
                                                            <th style="width: 13%">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($payments as $payment)
                                                            @if ($payment->month_id == $month->id && $payment->year == $y)
                                                                <tr>
                                                                    <td><a href="#" class="payment-details" data-payment-id="{{ $payment->payment_intent_id }}">
                                                                        {{ $payment->payment_intent_id }}
                                                                    </a></td>
                                                                    <td>RM{{ $payment->amount }}</td>
                                                                    <td>{{ $payment->created_at }}</td>
                                                                    <td><i class="fa fa-circle-check ps-3"></i></td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <div class="col-12 pl-1">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="ps-4 py-1">
                                                        <form id="payment-form-{{ $y }}-{{ $month->id }}" action="{{ route('pembayaran.session') }}" method="POST" >
                                                            @csrf
                                                            <input type="hidden" name="year" value="{{ $y }}">
                                                            <input type="hidden" name="month_id" value="{{ $month->id }}">
                                                            <input type="hidden" name="student_id" value="{{ $student_id }}">
                                                            <button class="btn btn-primary" type="submit"><i class="fa fa-money-bill"></i> Bayar</button>
                                                        </form>
                                                    </div>
                                                    <div><i class="fa fa-times-circle me-5 pe-5"></i></div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>            
                </div>
            </div>
            @endforeach
        @endif

    </div>
</div>

<livewire:payment.view-payment-details />

@endsection

@section('js')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var paymentLinks = document.querySelectorAll('.payment-details');

        paymentLinks.forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.preventDefault();
                var paymentId = link.getAttribute('data-payment-id');
                Livewire.emit('paymentSelected', paymentId);
            });
        });

        window.addEventListener('show-payment-modal', event => {
            var paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
            paymentModal.show();
        });
    });
</script>

@endsection
