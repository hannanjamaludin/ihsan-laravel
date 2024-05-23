<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Staffs;
use App\Models\Students;
use App\Models\TadikaClass;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class StudentController extends Controller
{
    public function index(){
        $teacher = Staffs::where('user_id', Auth::user()->id)->first();
        $branch = Branch::where('id', $teacher->branch_id)->first();
        $class = TadikaClass::with('teacher')
                            ->where('id', $teacher->class_room)
                            ->first();
        $today = Carbon::now();
    
        // $formattedDate = Carbon::createFromFormat('d/m/Y', $today)->format('Y-m-d');
        // $presentStudents = Attendance::where('class_id', $class->id)
        //                              ->where('date', $formattedDate)
        //                              ->where('status', 1)
        //                              ->with('student')
        //                              ->get();
        // $totalStudents = Students::where('class_id', $class->id)->count();
    
        return view('student-activity.index', [
            'class' => $class,
            'teacher' => $teacher,
            'branch' => $branch,
            'today' => $today,
            // 'presentStudents' => $presentStudents,
            // 'totalStudents' => $totalStudents,
        ]);
    }

    public function studentClass(){
        $teacher = Staffs::where('user_id', Auth::user()->id)->first();

        if($teacher->branch_id == 1){
            $classes = TadikaClass::where('branch', 1)->get();
        } else{
            $classes = TadikaClass::where('branch', 2)->get();
        }

        // dd($class);
        return view('student-activity.student-class', [
            'classes' => $classes,
            'teacher' => $teacher
        ]);
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

            $view_btn = '<a href="'. route('murid.kelas_detail', ['classId' => $cls->id]) .'" class="btn btn-info me-3 px-2 pb-1 pt-0" style="background-color: var(--custom-info-color); border:none;"
                                title="Maklumat lanjut">
                                <i class="fas fa-eye text-light mx-1" style="font-size: 10px;"></i>
                            </a>';
            
            $edit_btn = '<button type="button" class="btn btn-primary me-3 px-2 pb-1 pt-0" 
                            title="Kemaskini" onclick="Livewire.emit(\'editClass\', '. $cls->id .')">
                            <i class="fas fa-pen-to-square mx-1" style="font-size: 10px;"></i>
                        </button>';

            // $edit_btn = '<button type="button" class="btn btn-primary me-3 px-2 pb-1 pt-0" 
            //                 title="Kemaskini" onclick="editClass('.  $cls->id . ');">
            //                 <i class="fas fa-pen-to-square mx-1" style="font-size: 10px;"></i>
            //             </button>';

            $class_list[] = [
                'class' => $cls->age . ' ' . $cls->class_name,
                'capacity' => $cls->capacity,
                'total_student' => $progress_bar,
                'action' => $view_btn . $edit_btn,
            ];
        }

        return datatables()->of($class_list)->addIndexColumn()->make();
    }

    public function datatable_room_list(){
        $rooms = TadikaClass::where('branch', 1)->get();

        $room_list = [];

        foreach ($rooms as $room){
            $total_students = $room->total_students;
            $capacity = $room->capacity;
            $percentage = ($total_students / $capacity) * 100;

            $progress_bar = '<div class="progress">
                                <div class="progress-bar-striped bg-primary text-light" role="progressbar" style="width: ' . $percentage . '%;" aria-valuenow="' . $percentage . '" aria-valuemin="0" aria-valuemax="100">' . $total_students . '/' . $capacity . '</div>
                            </div>';

            $view_btn = '<a href="'. route('murid.kelas_detail', ['classId' => $room->id]) .'" class="btn btn-info me-3 px-2 pb-1 pt-0" style="background-color: var(--custom-info-color); border:none;"
                                title="Maklumat lanjut">
                                <i class="fas fa-eye text-light mx-1" style="font-size: 10px;"></i>
                            </a>';
            
            $edit_btn = '<a href="#" class="btn btn-primary me-3 px-2 pb-1 pt-0" style="background-color: var(--custom-primary-color); border:none;"
                            title="Kemaskini">
                            <i class="fas fa-pen-to-square text-light mx-1" style="font-size: 10px;"></i>
                        </a>';

            $room_list[] = [
                'room' => $room->age . ' ' . $room->class_name,
                'capacity' => $room->capacity,
                'total_student' => $progress_bar,
                'action' => $view_btn . $edit_btn,
            ];
        }

        return datatables()->of($room_list)->addIndexColumn()->make();
    }

    public function classDetails($id){

        $class = TadikaClass::find($id);

        return view('student-activity.class-detail', ['class' => $class]);
    }

    public function datatable_student_list(Request $request){
        $students = Students::where('class_id', $request->class_id)->get();

        $student_list = [];

        foreach($students as $student){

            $today = new DateTime();
            $dob = new DateTime($student->dob);
            $age = $dob->diff($today)->y;

            $delete_btn = '<button type="button" class="btn btn-primary me-3 px-2 pb-1 pt-0" 
                                title="Buang Murid daripada kelas" onclick="removeStudentFromClass('.  $student->id . ');">
                                <i class="fas fa-minus mx-1" style="font-size: 10px;"></i>
                            </button>';

            $student_list[] = [
                'name' => $student->full_name,
                'gender' => $student->gender,
                'age' => $age . ' Tahun',
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

        return response()->json(['success' => 'Murid telah dimasukkan dalam senarai kelas']);
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

        return response()->json(['success' => 'Murid telah dikeluarkan dari senarai kelas']);
    }
}
