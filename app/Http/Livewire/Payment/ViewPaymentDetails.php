<?php

namespace App\Http\Livewire\Payment;

use App\Models\StripePayment;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ViewPaymentDetails extends Component
{
    public $payment;

    protected $listeners = ['paymentSelected'];

    public function paymentSelected($paymentIntentId)
    {
        $this->payment = StripePayment::where('payment_intent_id', $paymentIntentId)
                                    ->with('students.user.parents', 'students.branch', 'months')
                                    ->first();

                                    // dd($this->payment);

        $this->dispatchBrowserEvent('show-payment-modal');
    }

    public function render()
    {
        return view('livewire.payment.view-payment-details');
    }
}
