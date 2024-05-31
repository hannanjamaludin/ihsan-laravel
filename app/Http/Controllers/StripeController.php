<?php

namespace App\Http\Controllers;

use App\Models\StripePayment;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\StripeClient;

class StripeController extends Controller
{

    // public function session(Request $request){

    //     $stripe = new StripeClient(env('STRIPE_SECRET'));

    //     $month_id = $request->month_id;
    //     $student_id = $request->student_id;
        
    //     $session = $stripe->checkout->sessions->create([
    //         'payment_method_types' => ['card'],
    //         'line_items' => [[
    //             'price_data' => [
    //                 'currency' => 'MYR',
    //                 'product_data' => [
    //                     'name' => 'Yuran Bulan ' . $month_id,
    //                 ],
    //                 'unit_amount' => 5000,
    //             ],
    //             'quantity' => 1,
    //         ]],
    //         'mode' => 'payment',
    //         // 'success_url' => route('pembayaran.status', ['studentId' => $student_id, 'monthId' => $month_id]) . '&session_id={CHECKOUT_SESSION_ID}',
    //         'success_url' => route('pembayaran.status', ['studentId' => $student_id, 'monthId' => $month_id,]) . '/{CHECKOUT_SESSION_ID}',
    //         // 'success_url' => route('pembayaran.status', ['studentId' => $student_id, 'monthId' => $month_id,]),
    //         'cancel_url' => route('pembayaran.yuran_student', ['studentId' => $student_id]),
    //     ]);

    //     // dd($session);

    //     return redirect()->away($session->url);
    // }
    
    // public function status($id, $month, $session_id, Request $request){

    //     $stripe = new StripeClient(env('STRIPE_SECRET'));
    
    //     // $session = $stripe->checkout->sessions->retrieve($session_id);
    //     $session = $stripe->checkout->sessions->retrieve('cs_test_a149PwplVdJfPGoJPZYDQuRZChISJ2EERjbgKcqFzT1Cj3GDZmHedoqLSY');

    //     // dd($session);   
        
    //     if ($session->payment_status === 'paid'){

    //         $requestData = [
    //             'month_id' => $month,
    //             'student_id' => $id,
    //             'user_email' => Auth::user()->email,
    //             'method' => 'card',
    //             'currency' => $session->currency,
    //         ];
            
    //         $payment = StripePayment::create([
    //             'payment_intent_id' => $session->id,
    //             'method' => 'card',
    //             'currency' => $session->currency,
    //             'month_id' => $month,
    //             'student_id' => $id,
    //             'user_email' => Auth::user()->email,
    //             'amount' => $session->amount_total/100,
    //             'json_response' => json_encode($requestData)
    //         ]);

    //         return view('payment.payment-status', ['student_id' => $id, 'status' => 'Berjaya!']);
    //     } else {
    //         return view('payment.payment-status', ['student_id' => $id, 'status' => 'Gagal']);
    //     }

    // }

    // private $session = null;

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
        
        //  dd($request->all(), $fee);
        
        $success_url = route('pembayaran.status', ['studentId' => $student_id, 'year' => $year, 'monthId' => $month_id]);
        
        // Debug: Log the success URL to verify it includes the session ID placeholder
        // logger()->info('Success URL:', ['url' => $success_url]);
    
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
    
        // Debug: Log the session object to verify it was created successfully
        // logger()->info('Checkout session:', ['session' => $session]);

        // dd($session);

        session(['stripe_session' => $session]);
        
        return redirect()->away($session->url);
    }
    
    public function status($id, $year, $month, Request $request){
        
        // dd(session('stripe_session'));
        
        $session = session('stripe_session');
        // dd($session);

        if ($session){

            // $stripe = new StripeClient(env('STRIPE_SECRET'));
            // $session = $stripe->checkout->sessions->retrieve($passed_session->id);
    
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
