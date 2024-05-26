<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function studentProfile(){
        $students = Students::where('user_id', Auth::user()->id)
                        ->where('is_active', 1)
                        ->with('branch')->get();

        return view('student.student-profile', [
            'students' => $students
        ]);
    }

    public function studentActivity(){
        return view('student.student-activity');
    }
}
