@extends('layouts.auth-app')
@section('content')

<div class="row">
    <div class="col-12">
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
            
                            
                            <div class="collapse multi-collapse" id="payment{{ $y }}-{{ $key }}">
                                <div class="card-body py-2 px-0 w-auto" style="background-color: #EAEAEA">
                                    {{-- @if(isset($paymentMonths[$month->id])) --}}
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
                                                                <td><a href="">{{ $payment->payment_intent_id }}</a></td>
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
    </div>
</div>

@endsection