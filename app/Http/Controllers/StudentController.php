<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Student\StudentTadikaActivity;
use App\Models\Staffs;
use App\Models\Students;
use App\Models\TadikaActivity;
use App\Models\TadikaActivityStudent;
use App\Models\TadikaClass;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function studentProfile(){
        $students = Students::where('user_id', Auth::user()->id)
                        ->where('is_active', 1)
                        ->with('branch')->get();

                        // dd($students);

        return view('student.student-profile', [
            'students' => $students
        ]);
    }

    public function profileDetail($studentId){
        $student = Students::where('id', $studentId)
                            ->with('branch')->first();
        // dd($student);

        return view('student.student-profile-detail', [
            'student' => $student,
        ]);
    }

    public function updateStudent($id, Request $request){

        $student = Students::findOrFail($id);
        $branch = 1;

        if ($request->input('branch_id') == 'Tadika Ihsan'){
            $branch = 2;
        }

        if ($student){
            $student->update([
                'full_name' => $request->input('full_name'),
                'ic_no' => $request->input('ic_no'),
                'dob' => $request->input('dob'),
                'gender' => $request->input('gender'),
                'siblings' => $request->input('siblings'),
                'allergy' => $request->input('allergy'),
                'disability' => $request->input('disability'),
                'illness' => $request->input('illness'),
                'study' => $request->input('study'),
                'address1' => $request->input('address1'),
                'state' => $request->input('state'),
                'district' => $request->input('district'),
                'postcode' => $request->input('postcode'),
                'branch_id' => $branch,
            ]);
        }
        return response()->json(['success' => true]);
    }

    public function studentActivity(){

        $teacher = Staffs::where('user_id', Auth::user()->id)
                        ->with('assignedClass')
                        ->first();

        $class = TadikaClass::with('teacher')
                            ->where('id', $teacher->class_room)
                            ->first();
        
        $today = Carbon::now();
                
        // dd($teacher);

        return view('student.student-activity', [
            'teacher' => $teacher,
            'class' => $class,
            'today' => $today
        ]);
    }

}
