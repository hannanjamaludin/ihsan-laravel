<?php

namespace App\Http\Controllers;

use App\Models\Month;
use App\Models\Payment;
use App\Models\StripePayment;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(){

        $students = Students::where('user_id', Auth::user()->id)
                            ->where('is_active', 1)
                            ->with('branch')->get();

        return view('payment.index', [
            'students' => $students
        ]);
    }

    public function paymentByStudent($id){

        $months = Month::get();
        // $payments = Payment::where('user_email', Auth::user()->email)
        //                     ->where('student_id', $id)->with('students')->get();
        $payments = StripePayment::where('user_email', Auth::user()->email)
                                    ->where('student_id', $id)->with('students')->get();
    
        $paymentMonths = [];

        // dd($payments);
    
        foreach ($payments as $payment) {
            $paymentMonths[$payment->month_id] = true;
        }

        // dd($paymentMonths, $payments);
        
        return view('payment.payment-student', [
            'months' => $months,
            'student_id' => $id,
            'payments' => $payments,
            'paymentMonths' => $paymentMonths, // Pass the array to the view
        ]);
    }

    // public function makePayment(){
    //     // return view('payment.make-payment');
    //     return view('payment.make-payment-stripe');
    // }
}
