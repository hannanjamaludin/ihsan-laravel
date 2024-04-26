<?php

namespace App\Http\Controllers;

use App\Models\StripePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\StripeClient;

class StripeController extends Controller
{

    public function session(Request $request){

        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $month_id = $request->month_id;
        $student_id = $request->student_id;
        
        $session = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'MYR',
                    'product_data' => [
                        'name' => 'Yuran Bulan ' . $month_id,
                    ],
                    'unit_amount' => 5000,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            // 'success_url' => route('pembayaran.status', ['studentId' => $student_id, 'monthId' => $month_id]) . '&session_id={CHECKOUT_SESSION_ID}',
            'success_url' => route('pembayaran.status', ['studentId' => $student_id, 'monthId' => $month_id,]) . '/{CHECKOUT_SESSION_ID}',
            'cancel_url' => route('pembayaran.yuran_student', ['studentId' => $student_id]),
        ]);

        // dd($session);

        return redirect()->away($session->url);
    }
    
    public function status($id, $month, $session_id, Request $request){

        $stripe = new StripeClient(env('STRIPE_SECRET'));
    
        $session = $stripe->checkout->sessions->retrieve($session_id);

        // dd($session);   
        
        if ($session->payment_status === 'paid'){

            $requestData = [
                'month_id' => $month,
                'student_id' => $id,
                'user_email' => Auth::user()->email,
                'method' => 'card',
                'currency' => $session->currency,
            ];
            
            $payment = StripePayment::create([
                'payment_intent_id' => $session->id,
                'method' => 'card',
                'currency' => $session->currency,
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

}
