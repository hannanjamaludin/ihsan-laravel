<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\TadikaClass;
use DateTime;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        return view('student-activity.index');
    }

    public function studentClass(){
        $classes = TadikaClass::where('branch', 2)->get();

        // dd($class);
        return view('student-activity.student-class', ['classes' => $classes]);
    }

    public function datatable_class_list(){
        $class = TadikaClass::where('branch', 2)->get();

        $class_list = [];

        foreach ($class as $cls){
            $total_students = $cls->total_students;
            $capacity = $cls->capacity;
            $percentage = ($total_students / $capacity) * 100;

            $progress_bar = '<div class="progress">
                                <div class="progress-bar-striped bg-primary text-light" role="progressbar" style="width: ' . $percentage . '%;" aria-valuenow="' . $percentage . '" aria-valuemin="0" aria-valuemax="100">' . $total_students . '/' . $capacity . '</div>
                            </div>';

            $view_btn = '<a href="'. route('pelajar.kelas_detail', ['classId' => $cls->id]) .'" class="btn btn-info me-3 px-2 pb-1 pt-0" style="background-color: var(--custom-info-color); border:none;"
                                title="Maklumat lanjut">
                                <i class="fas fa-eye text-light mx-1" style="font-size: 10px;"></i>
                            </a>';
            
            $edit_btn = '<a href="#" class="btn btn-primary me-3 px-2 pb-1 pt-0" style="background-color: var(--custom-primary-color); border:none;"
                            title="Kemaskini">
                            <i class="fas fa-pen-to-square text-light mx-1" style="font-size: 10px;"></i>
                        </a>';

            $class_list[] = [
                'class' => $cls->age . ' ' . $cls->class_name,
                'capacity' => $cls->capacity,
                'total_student' => $progress_bar,
                'action' => $view_btn . $edit_btn,
            ];
        }

        return datatables()->of($class_list)->addIndexColumn()->make();
    }

    public function classDetails($id){

        $class = TadikaClass::find($id);

        return view('student-activity.class-detail', ['class' => $class]);
    }

    public function datatable_student_list(Request $request){
        $students = Students::where('class_id', $request->class_id)->get();

        $student_list = [];

        foreach($students as $student){

            $delete_btn = '<button type="button" class="btn btn-primary me-3 px-2 pb-1 pt-0" 
                                title="Buang pelajar daripada kelas" onclick="removeStudentFromClass('.  $student->id . ');">
                                <i class="fas fa-minus mx-1" style="font-size: 10px;"></i>
                            </button>';

            $student_list[] = [
                'name' => $student->full_name,
                'gender' => $student->gender,
                'enroll_date' => $student->enroll_date,
                'action' => $delete_btn
            ];
        }

        return datatables()->of($student_list)->addIndexColumn()->make();
    }

    public function datatable_all_student_list(Request $request){
        
        $class = TadikaClass::findOrFail($request->class_id);

        $students = Students::where('branch_id', $class->branch)->where('class_id', null)->get();

        $student_list = [];

        foreach ($students as $student){
            $today = new DateTime();
            $dob = new DateTime($student->dob);
            $age = $dob->diff($today)->y;

            $student_list[] = [
                'name' => $student->full_name,
                'gender' => $student->gender,
                'age' => $age . ' Tahun',
                'enroll_date' => $student->enroll_date,
                'id' => $student->id
            ];
        }

        return datatables()->of($student_list)->addIndexColumn()->make();
    }

    public function addStudentToClass(Request $request){
        $student_id = $request->student_id;
        $class_id = $request->class_id;

        $student = Students::findOrFail($student_id);
        $student->update([
            'class_id' => $class_id,
        ]);

        $class = TadikaClass::where('id', $class_id)->first();
        $current_count = $class->total_students;
        $current_count++;

        $class->update([
            'total_students' => $current_count
        ]);

        return response()->json(['success' => 'Pelajar telah dimasukkan dalam senarai kelas']);
    }

    public function removeStudentFromClass(Request $request){
        $student_id = $request->student_id;
        $class_id = $request->class_id;

        $student = Students::findOrFail($student_id);
        $student->update([
            'class_id' => null,
        ]);

        $class = TadikaClass::where('id', $class_id)->first();
        $current_count = $class->total_students;
        $current_count--;

        $class->update([
            'total_students' => $current_count
        ]);

        return response()->json(['success' => 'Pelajar telah dikeluarkan dari senarai kelas']);
    }
}
