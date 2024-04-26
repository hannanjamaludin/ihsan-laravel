@extends('layouts.auth-app')
@section('content')

<div class="row">
    <div class="col-12">
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
                        <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#payment{{ $key }}" aria-expanded="false" title="Collapse">
                            <i class="fas fa-chevron-down" style="color: black"></i>
                        </button>
                    </div>
                </div>

                
                <div class="collapse multi-collapse" id="payment{{ $key }}">
                    <div class="card-body py-2 px-0 w-auto" style="background-color: #EAEAEA">
                        {{-- @php
                            $hasPayment = false;
                        @endphp
                        @foreach ($paymentMonths as $paymentMonth)
                            @if ($paymentMonth == $month->id)
                                @php
                                    $hasPayment = true;
                                @endphp --}}
                            @if(isset($paymentMonths[$month->id]))
                                <div class="col-12 pl-1">
                                    {{-- {{ $month->month }} --}}
                                    <table id="paid_table" class="table">
                                        <thead>
                                            <tr>
                                                <th>Rujukan</th>
                                                <th>Amaun</th>
                                                <th>Tarikh</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($payments as $payment)
                                            @if ($payment->month_id == $month->id)
                                                <tr>
                                                    <td><a href="">{{ $payment->r_payment_id }}</a></td>
                                                    <td>RM{{ $payment->amount }}</td>
                                                    <td>{{ $payment->created_at }}</td>
                                                    <td><i class="fa fa-circle-check ps-3"></i></td>
                                                </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            {{-- @endif --}}
                            @else
                            {{-- @if (!$hasPayment)  --}}
                            @foreach ($payments as $payment)        
                                <div class="col-12 pl-1">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="ps-4 py-1">
                                            <form action="{{ route('razorpay.payment.store') }}" method="POST" >
                                            @csrf
                                                <input type="hidden" name="month_id" value="{{ $month->id }}">
                                                <input type="hidden" name="student_id" value="{{ $payment->students->id }}">
                                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                                    data-key="{{ env('RAZORPAY_KEY') }}"
                                                    data-amount="5000"
                                                    data-currency="MYR"
                                                    data-buttontext="Bayar"
                                                    data-name="Tadika Ihsan"
                                                    data-description="Pembayaran yuran bulan {{ $month->month }}"
                                                    data-image="{{ asset('assets/img/ihsan-logo-16x16.png') }}"
                                                    data-prefill.name=""
                                                    data-prefill.email=""
                                                    data-theme.color="#703232">
                                                </script>
                                            </form>
                                        </div>
                                        <div><i class="fa fa-times-circle me-5 pe-5"></i></div>
                                    </div>
                                </div>
                            
                            @endforeach
                            @endif
                        {{-- @endforeach --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

@section('css')

<style>
    /* Customize the Razorpay checkout button */
    .razorpay-payment-button {
        background-color: #703232; 
        color: #fff; 
        border-radius: 5px; 
        padding: 5px 20px; 
        font-size: 16px; 
        border: none; 
        cursor: pointer;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Hover effect */
    .razorpay-payment-button:hover {
        background-color: #703232; /* Change background color on hover */
    }

    .table>:not(caption)>*>* {
        padding-left: 30px;
        background-color: var(--bs-table-bg);
        border-bottom-width: 1px;
        box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
    }

</style>

@endsection