<?php

namespace App\Http\Controllers;

use App\Models\Month;
use App\Models\Payment;
use App\Models\StripePayment;
use App\Models\Students;
use DateTime;
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

        $student = Students::selectRaw('YEAR(enroll_date) AS enroll_year')->find($id);

        $enrollYear = $student->enroll_year;

        // $enroll = new DateTime($student->enroll_date);
        // $current = new DateTime();
        // $years = $current->diff($enroll)->y + 1; // add current year
        $currentYear = date('Y'); // Current year
        $years = range($enrollYear, $currentYear); // Array of years from enrollment year to current year

        // dd($enrollYear, $years, $student);

        $months = Month::get();
        // $payments = Payment::where('user_email', Auth::user()->email)
        //                     ->where('student_id', $id)->with('students')->get();
        $payments = StripePayment::where('user_email', Auth::user()->email)
                                    ->where('student_id', $id)->with('students')
                                    ->get();
    
        $paymentMonths = [];

        $paymentYears = [];

        // dd($payments, $students);

        $paymentMonthsYears = [];

        foreach ($payments as $payment) {
            $paymentMonthsYears[$payment->year][$payment->month_id] = true;
        }

    
        // foreach ($payments as $payment) {
        //     $paymentMonths[$payment->month_id] = true;
        //     $paymentYears[$payment->year] = true;
        // }

        // dd($paymentMonthsYears);
        
        return view('payment.payment-student', [
            'months' => $months,
            'student_id' => $id,
            'payments' => $payments,
            // 'paymentMonths' => $paymentMonths, // Pass the array to the view
            'years' => $years,
            // 'paymentYears' => $paymentYears,
            'paymentMonthsYears' => $paymentMonthsYears,
        ]);
    }

    // public function makePayment(){
    //     // return view('payment.make-payment');
    //     return view('payment.make-payment-stripe');
    // }
}
