@extends('layouts.auth-app')
@section('content')

<div class="card card-default">
    <div class="card-header">
        Laravel - Razorpay Payment Gateway Integration
    </div>
    <div class="card-body text-center">
        {{-- <form action="{{ route('razorpay.payment.store') }}" method="POST" >
            @csrf 
            <script src="https://checkout.razorpay.com/v1/checkout.js"
                    data-key="{{ env('RAZORPAY_KEY') }}"
                    data-amount="5000"
                    data-currency="MYR"
                    data-buttontext="Bayar 50 MYR"
                    data-name="Tadika Ihsan"
                    data-description="Pembayaran yuran bulan Januari"
                    data-image="{{ asset('assets/img/ihsan-logo-16x16.png') }}"
                    data-prefill.name="ABC"
                    data-prefill.email="abc@gmail.com"
                    data-theme.color="#703232">
            </script>
        </form> --}}
        <form action="{{ route('razorpay.payment.store') }}" method="POST" >
            @csrf
            <button id="rzp-button1" class="btn btn-primary"><i class="fa fa-money-bill"></i>
                Bayar
            </button>
        </form>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
            document.getElementById('rzp-button1').addEventListener('click', function() {
                var options = {
                    "key": "{{ env('RAZORPAY_KEY') }}",
                    "amount": "1000",
                    "currency": "MYR",
                    "description": "Pembayaran yuran bulan Januari",
                    "image": "{{asset('assets/img/ihsan-logo-16x16.png')}}",
                    "theme": {
                        "color": "#703232"
                    },
                    "prefill": {
                        "email": "test@example.com",
                    },
                    // config: {
                    //     display: {
                    //         blocks: {
                    //             banks: {
                    //                 name: "All payment methods",
                    //                 instruments: [
                    //                     {
                    //                         method: 'card',
                    //                     },
                    //                     {
                    //                         method: 'wallet',
                    //                     },
                    //                     {
                    //                         method: 'fpx',
                    //                     },
                    //                 ],
                    //             },
                    //         },
                    //         sequence: ['block.banks'],
                    //         preferences: {
                    //             show_default_blocks: false,
                    //         },
                    //     },
                    // },
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();
            });        
    </script>
    </div>
</div>

@endsection