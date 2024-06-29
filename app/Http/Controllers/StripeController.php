<?php

namespace App\Http\Controllers;

use App\Models\StripePayment;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\StripeClient;

class StripeController extends Controller
{
    public function session(Request $request){

        $stripe = new StripeClient(env('STRIPE_SECRET'));
    
        $year = $request->year;
        $month_id = $request->month_id;
        $student_id = $request->student_id;

        $student = Students::with('assignedClass')->find($student_id);
        if (!$student || !$student->assignedClass) {
            return response()->json(['error' => 'Fee is not available yet.'], 400);
        }

        $fee = $student->assignedClass->fee;
        // Check if the fee is not available (null)
        if (is_null($fee)) {
            return response()->json(['error' => 'Yuran masih belum tersedia.'], 400);
        }
        
        $success_url = route('pembayaran.status', ['studentId' => $student_id, 'year' => $year, 'monthId' => $month_id]);

        $session = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'MYR',
                    'product_data' => [
                        'name' => 'Yuran Bulan ' . $month_id . ' Tahun ' . $year,
                    ],
                    'unit_amount' => $fee * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $success_url,
            'cancel_url' => route('pembayaran.yuran_student', ['studentId' => $student_id]),
        ]);
    
        session(['stripe_session' => $session]);
        
        return redirect()->away($session->url);
    }
    
    public function status($id, $year, $month, Request $request){
        
        $session = session('stripe_session');

        if ($session){
    
            $requestData = [
                'year' => $year,
                'month_id' => $month,
                'student_id' => $id,
                'user_email' => Auth::user()->email,
                'method' => 'card',
                'currency' => $session->currency,
            ];

            $transactionNumber = $this->generateTransactionNumber();
            
            $payment = StripePayment::create([
                'payment_intent_id' => $session->id,
                'transaction_number' => $transactionNumber,
                'method' => 'card',
                'currency' => $session->currency,
                'year' => $year,
                'month_id' => $month,
                'student_id' => $id,
                'user_email' => Auth::user()->email,
                'amount' => $session->amount_total/100,
                'json_response' => json_encode($requestData)
            ]);

            return view('payment.payment-status', ['student_id' => $id, 'status' => 'Berjaya!']);
        } else {
            return view('payment.payment-status', ['student_id' => $id, 'status' => 'Gagal']);
        }
    }

    private function generateTransactionNumber() {
        $timestamp = time();
        $randomString = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);

        return $timestamp.$randomString;
    }
}
