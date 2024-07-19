<?php

namespace App\Http\Livewire\Home;

use App\Models\Month;
use App\Models\StripePayment;
use App\Models\Students;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ParentHomePage extends Component
{
    public function render()
    {
        $user = User::with('parents')->findOrFail(Auth::user()->id);

        $children = Students::where('user_id', Auth::user()->id)
                            ->where('is_active', 1)
                            ->with('branch', 'assignedClass')
                            ->get();

        $students = Students::whereHas('user', function($query) use ($user) {
                                $query->where('id', $user->id);
                            })
                            ->orderBy('updated_at', 'desc')   
                            ->take(3)
                            ->get();

        $month = Month::where('id', Carbon::now()->month)->first();  
        
        $payments = [];
        
        foreach ($children as $child) {
            $payments[$child->id] = StripePayment::where('month_id', $month->id)
                                                ->where('year', Carbon::now()->year)
                                                ->where('student_id', $child->id)
                                                ->first();
        }

        return view('livewire.home.parent-home-page', [
            'user' => $user,
            'children' => $children,
            'students' => $students,
            'month' => $month,
            'payments' => $payments
        ]);
    }
}
