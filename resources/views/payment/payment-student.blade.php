@extends('layouts.auth-app')
@section('content')

<div class="row">
    <div class="col-12">
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
                    <div class="card-body px-3 pt-2 pb-2 w-auto" style="background-color: #EAEAEA">
                        @php
                            $hasPayment = false;
                        @endphp
                        @foreach ($paymentMonths as $paymentMonth)
                            @if ($paymentMonth == $month->id)
                                @php
                                    $hasPayment = true;
                                @endphp
                                <div class="col-12 pl-1">Buat table payment history {{ $month->month }}</div>
                            @endif

                            @if (!$hasPayment) 
                            <form action="{{ route('razorpay.payment.store') }}" method="POST" >
                                @csrf              
                                {{-- <button id="rzp-button1" class="btn btn-primary"><i class="fa fa-credit-card"></i>
                                    Bayar
                                </button> --}}
                                <script src="https://checkout.razorpay.com/v1/checkout.js"
                                    data-key="{{ env('RAZORPAY_KEY') }}"
                                    data-amount="5000"
                                    data-currency="MYR"
                                    data-buttontext="Bayar"
                                    data-name="Tadika Ihsan"
                                    data-description="Pembayaran yuran bulan {{ $month->month }}"
                                    data-image="{{ asset('assets/img/ihsan-logo-16x16.png') }}"
                                    data-prefill.name="ABC"
                                    data-prefill.email="abc@gmail.com"
                                    data-theme.color="#703232">
                                </script>
                            </form>
                            @endif
                        @endforeach
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
</style>

@endsection