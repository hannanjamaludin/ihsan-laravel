<?php

namespace App\Http\Livewire\Student;

use App\Models\Staffs;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentActivity extends Component
{
    public function render()
    {
        $teacher = Staffs::where('user_id', Auth::user()->id)
                        ->with('assignedClass')
                        ->first();

        $today = Carbon::now();
        $formattedDate = $today->format('d/m/Y');
                
        return view('livewire.student.student-activity', [
            'teacher' => $teacher,
            'date' => $formattedDate,
        ]);
    }
}
