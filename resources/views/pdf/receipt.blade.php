<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Resit Pembayaran</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header .left-section {
            display: flex;
            align-items: center;
        }
        .header .logo img {
            height: 50px; /* Adjusted height */
            object-fit: contain;
            margin-right: 10px;
        }
        .header .address {
            display: flex;
            flex-direction: column;
        }
        .content {
            width: 100%;
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        #tableBawah, #tableBawah th, #tableBawah td {
            border: 1px solid #000;
        }
        .table th, .table td {
            padding: 8px;
            text-align: left;
        }
        .text-center {
            text-align: center;
        }
        .text-end {
            text-align: right;
        }
        .fw-bolder {
            font-weight: bold;
        }
        .mb-3 {
            margin-bottom: 1rem;
        }
        .py-5 {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }
        .receipt-title {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <table class="table" style="width: 100%">
                <tr>
                    <td>
                        <div class="logo">
                            <img src="{{ asset('assets/img/logo-UTM.png') }}" alt="logo UTM">
                        </div>
                    </td>
                    <td style="width: 50%;">
                        <div class="address">
                            <div class="fw-bolder">Universiti Teknologi Malaysia</div>
                            <div class="fw-bolder">81310 Skudai, Johor Bahru</div>
                            <div class="fw-bolder">Johor, Malaysia</div>
                        </div>
                    </td>
                    <td style="vertical-align: top; text-align: right; width:30%;">
                        <div class="receipt-title">
                            <div class="fs-5 fw-bolder">RESIT RASMI</div>
                        </div>
                    </td>
                </tr>

            </table>
        </div>
        <div class="content">
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
                    <table class="table">
                        @if ($payment)
                            <tr>
                                <td>NAMA PEMBAYAR:</td>
                                <td>{{ strtoupper($payment->students->user->parents->full_name) }}</td>
                            </tr>
                            <tr>
                                <td>NOMBOR TRANSAKSI PEMBAYAR:</td>
                                <td>{{ $payment->transaction_number ?? '' }}</td>
                            </tr>
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
                    <table class="table table-bordered" id="tableBawah" style="border: #000 solid 1px;">
                        <thead class="text-center">
                            <th>NO</th>
                            <th>KETERANGAN</th>
                            <th>AMAUN (RM)</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-start">YURAN BULANAN {{ strtoupper($payment->students->branch->branch_name) }} {{ strtoupper($payment->students->full_name) }}</td>
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
            @endif
        </div>
    </div>
</body>
</html>
