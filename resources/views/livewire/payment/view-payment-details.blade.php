<div>
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                                {{-- {{ dd($payment) }} --}}
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
                                        <td class="">CARD PAYMENT</td>
                                    </tr>
                                    <tr class="">
                                        <td class="">TRANSACTION STATUS:</td>
                                        <td class="">SUCCESSFUL</td>
                                    </tr>
                                    <tr class="">
                                        <td class="">RECEIPT DATE:</td>
                                        <td class="">09052024</td>
                                    </tr>
                                    <tr class="">
                                        <td class="">MERCHANT NAME:</td>
                                        <td class="">UNIVERSITI TEKNOLOGI MALAYSIA</td>
                                    </tr>
                                    <tr class="">
                                        <td class="">ACADEMIC SESSION:</td>
                                        {{-- <td class="">{{ $payment->month_id }} {{ $payment->year }}</td> --}}
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
                                        <td class="text-center">RM </td>
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
    </div>
</div>

<style>
    .vertical-line {
        border-left: 1px solid #000; /* Adjust the color and thickness as needed */
        height: 100%;
    }
</style>
