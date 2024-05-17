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
                                                                {{-- <td><a href="#" class="payment-details" onclick="Livewire.emit('paymentClicked', '{{ $payment->payment_intent_id }}')" data-bs-toggle="modal" data-bs-target="#paymentModal"> --}}
                                                                <td><a href="#" class="payment-details" data-payment-id="{{ $payment->payment_intent_id }}" data-bs-toggle="modal" data-bs-target="#paymentModal">
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
                {{-- <livewire:payment.view-payment-details /> --}}

                {{-- Receipt Modal --}}
                {{-- <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content p-5">
             
                            <div class="modal-body m-3">
                                <div class="row mb-3">
                                    <div class="col-3">
                                        <img src="{{ asset('assets/img/logo-UTM.png') }}" class="img-fluid mb-3" alt="logo UTM">
                                    </div>
                                    <div class="col-6">
                                        <div class="fw-bolder">Universiti Teknologi Malaysia</div>
                                        <div class="fw-bolder">81310 Skudai, Johor Bahru</div>
                                        <div class="fw-bolder">Johor, Malaysia</div>
                                    </div>
                                    <div class="col-3 text-end">
                                        <div class="fs-5 fw-bolder">OFFICIAL RECEIPT</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="fw-bolder">Student Financial: Tel: +607-5530152/30597/30087; Email: bendahari-ukp@utm.my</div>
                                        <div class="fw-bolder">Others: Tel: +607-5530595/30270/31219/30897; Email: zubir@utm.my/hurulaini@utm.my/azliana@utm.my</div>
                                    </div>
                                </div>
                                <hr class="mt-0 mb-3">
                                <div class="row">
                                    <div class="col">
                                        <div class="fs-6 fw-bolder py-5">TRANSACTION DETAILS</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <table class="table table-borderless">
                                            @if ($payment)
                                            <tr class="">
                                                <td class="">BUYER NAME:</td>
                                                <td class="">NUR HANNAN BINTI JAMALUDIN</td>
                                            </tr>
                                            <tr class="">
                                                <td class="">BUYER ORDER NUMBER:</td>
                                                <td class="">{{ $payment->payment_intent_id }}</td>
                                            </tr>
                                            <tr class="">
                                                <td class="">BUYER ID:</td>
                                                <td class="">010415050130</td>
                                            </tr>
                                            <tr class="">
                                                <td class="">SOURCE:</td>
                                                <td class="">{{ $payment->method }}</td>
                                            </tr>
                                            <tr class="">
                                                <td class="">TRANSACTION STATUS:</td>
                                                <td class="">SUCCESSFUL</td>
                                            </tr>
                                            <tr class="">
                                                <td class="">RECEIPT DATE:</td>
                                                <td class="">{{ $payment->created_at }}</td>
                                            </tr>
                                            <tr class="">
                                                <td class="">MERCHANT NAME:</td>
                                                <td class="">UNIVERSITI TEKNOLOGI MALAYSIA</td>
                                            </tr>
                                            <tr class="">
                                                <td class="">ACADEMIC SESSION:</td>
                                                <td class="">{{ $payment->month_id }} {{ $payment->year }}</td>
                                            </tr>
                                            @else
                                            <tr>
                                                <td colspan="2">Payment details not found.</td>
                                            </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="fs-6 fw-bolder py-5">PAYMENT FOR</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <table class="table table-bordered" style="border: #000 solid 1px;">
                                            <thead class="text-center">
                                                <th>NO</th>
                                                <th>DESCRIPTION</th>
                                                <th>AMOUNT (RM)</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td class="text-start">SERVICE FEE, STUDY FEE</td>
                                                    <td class="text-center">RM 583.00</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-end fw-bolder" colspan="2">TOTAL AMOUNT</td>
                                                    <td class="text-center fw-bolder">RM 583.00</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="fs-6 fw-bolder mt-4 mb-5 pb-5 text-center">This is a computer generated receipt and does not require a signature</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            
            </div>
        </div>

        @endforeach
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

        // $('#paymentModal').on('hidden.bs.modal', function () {
        //     Livewire.emit('resetModal');
        // });

    });

</script>

@endsection