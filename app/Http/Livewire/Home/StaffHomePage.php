<?php

namespace App\Http\Livewire\Home;

use App\Models\Students;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StaffHomePage extends Component
{
    public function render()
    {
        $user = User::with('staffs')->findOrFail(Auth::user()->id);
        // dd($user);

        $students = Students::whereHas('branch', function($query) use ($user) {
                                $query->where('id', $user->staffs->branch_id);
                                // dd('masuk');
                            })
                            // ->whereHas('applicationStatus', function($query){
                            //     // $query->where('status', NULL);
                            //     $query->where('status', 1);
                            // })
                            ->with('mom', 'dad', 'branch', 'applicationStatus')
                            ->get();

        // dd($students);

        return view('livewire.home.staff-home-page', [
            '$user' => $user,
            'students' => $students,
        ]);
    }
}
