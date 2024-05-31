<?php

namespace App\Http\Controllers;

use App\Models\Month;
use App\Models\StripePayment;
use App\Models\Students;
use Barryvdh\DomPDF\Facade\Pdf;
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

        $student = Students::selectRaw('YEAR(enroll_date) AS enroll_year, class_id, full_name')->find($id);
        
        $enrollYear = $student->enroll_year;

        $currentYear = date('Y');
        $years = range($enrollYear, $currentYear); // Array of years from enrollment year to current year

        $months = Month::get();

        $payments = StripePayment::where('user_email', Auth::user()->email)
                                    ->where('student_id', $id)->with('students')
                                    ->get();
    
        $paymentMonthsYears = [];

        foreach ($payments as $payment) {
            $paymentMonthsYears[$payment->year][$payment->month_id] = true;
        }

        return view('payment.payment-student', [
            'months' => $months,
            'student_id' => $id,
            'payments' => $payments,
            'years' => $years,
            'paymentMonthsYears' => $paymentMonthsYears,
            'student' => $student,
            'class' => $student->class_id,
            'name' => $student->full_name,
        ]);
    }

    public function downloadReceipt($paymentId){
        $payment = StripePayment::where('payment_intent_id', $paymentId)
                                ->with('students.user.parents', 'months', 'students.branch')
                                ->first();
        
        if (!$payment) {
            return redirect()->back()->with('error', 'Rekod pembayaran tidak dijumpai');
        }

        $pdf = Pdf::loadView('pdf.receipt', compact('payment'));
        return $pdf->download('receipt.pdf');
    }
}
