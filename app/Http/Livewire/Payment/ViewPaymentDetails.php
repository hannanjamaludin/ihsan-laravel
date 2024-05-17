<?php

namespace App\Http\Livewire\Payment;

use App\Models\StripePayment;
use Livewire\Component;

class ViewPaymentDetails extends Component
{
    public $paymentId;
    public $payment;

    // protected $listeners = ['paymentClicked'];
    protected $listeners = [
        'paymentSelected' => 'loadPaymentDetails',
        // 'resetModal' => 'resetModalState'
    ];

    // Method to handle the emitted event and update the paymentId property
    public function paymentClicked($paymentId){
        // dd('masuk');
        $this->paymentId = $paymentId;

        // Fetch the payment details based on the new paymentId
        $this->payment = StripePayment::where('payment_intent_id', $this->paymentId)->first();

        // dd($this->payment);
    }

    public function loadPaymentDetails($paymentId){
        $this->paymentId = $paymentId;
        $this->payment = StripePayment::where('payment_intent_id', $paymentId)->first();
        // dd($this->payment);
    }

    // // Method to handle the click event and update the paymentId property
    // public function updatePaymentId($paymentId){
    //     $this->paymentId = $paymentId;
    //     // dd('masuk');
    //     // Fetch the payment details based on the new paymentId
    //     $this->payment = StripePayment::where('payment_intent_id', $this->paymentId)->first();
    // }

    // public function resetModalState()
    // {
    //     $this->paymentId = null;
    //     $this->payment = null;
    // }

    public function render()
    {
        // $payment = StripePayment::where('payment_intent_id', $this->paymentId)->first();

        // dd($this->payment);
        return view('livewire.payment.view-payment-details', ['payment' => $this->payment]);
        // return view('livewire.payment.view-payment-details');
    }

    // public function getPaymentDetails(Request $request){

    //     $student = Students::with(['mom', 'dad', 'branch'])
    //                         ->find($request->student_id);
                            
    //     return response()->json($student);
    // }
}
