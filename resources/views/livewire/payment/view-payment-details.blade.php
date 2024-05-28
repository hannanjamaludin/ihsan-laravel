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
                            <div class="fs-5 fw-bolder">RESIT RASMI</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="fw-bolder">Kewangan: Tel: +607-5530152/30597/30087; E-mel: bendahari-ukp@utm.my</div>
                            <div class="fw-bolder">Lain-lain: Tel: +607-5530595/30270/31219/30897; E-mel: zubir@utm.my/hurulaini@utm.my/azliana@utm.my</div>
                        </div>
                    </div>
                    <hr class="mt-0 mb-3">
                    <div class="row">
                        <div class="col">
                            <div class="fs-6 fw-bolder py-5">MAKLUMAT TRANSAKSI</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table class="table table-borderless">
                                @if ($payment)
                                    <tr>
                                        <td>NAMA PEMBAYAR:</td>
                                        <td>{{ strtoupper($payment->students->user->parents->full_name) }}</td>
                                    </tr>
                                    <tr>
                                        <td>NOMBOR TRANSAKSI PEMBAYAR:</td>
                                        <td>{{ $payment->payment_intent_id }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <td>ID PEMBAYAR:</td>
                                        <td>{{ $payment->students->user->parents->ic_no }}</td>
                                    </tr> --}}
                                    <tr>
                                        <td>SUMBER:</td>
                                        <td>PEMBAYARAN {{ strtoupper($payment->method) }}</td>
                                    </tr>
                                    <tr>
                                        <td>STATUS TRANSAKSI:</td>
                                        <td>BERJAYA</td>
                                    </tr>
                                    <tr>
                                        <td>TARIKH RESIT:</td>
                                        <td>{{ $payment->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td>NAMA PENIAGA:</td>
                                        <td>UNIVERSITI TEKNOLOGI MALAYSIA</td>
                                    </tr>
                                    <tr>
                                        <td>SESI AKADEMIK:</td>
                                        <td>{{ strtoupper($payment->months->month) }} {{ $payment->year }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="2">Maklumat transaksi tidak dijumpai.</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                    @if ($payment)
                    <div class="row">
                        <div class="col">
                            <div class="fs-6 fw-bolder py-5">PEMBAYARAN UNTUK</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered" style="border: #000 solid 1px;">
                                <thead class="text-center">
                                    <th>NO</th>
                                    <th>KETERANGAN</th>
                                    <th>AMAUN (RM)</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td class="text-start">YURAN BULANAN {{ strtoupper($payment->students->branch->branch_name) }}</td>
                                        <td class="text-center">RM {{ number_format($payment->amount, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-end fw-bolder" colspan="2">JUMLAH AMAUN</td>
                                        <td class="text-center fw-bolder">RM {{ number_format($payment->amount, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="fs-6 fw-bolder mt-4 mb-5 pb-5 text-center">Resit ini dijana oleh komputer dan tidak memerlukan tandatangan</div>
                        </div>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('payment.receipt.pdf', ['paymentId' => $payment->payment_intent_id]) }}" class="btn btn-primary" target="_blank">Muat Turun PDF</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
