<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Month;
use App\Models\Staffs;
use App\Models\Students;
use App\Models\TadikaClass;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    // function to navigate to attendance page
    public function index(){
        $teacher = Staffs::where('user_id', Auth::user()->id)->first();
        $branch = Branch::where('id', $teacher->branch_id)->first();
        $class = TadikaClass::with('teacher')
                            ->where('id', $teacher->class_room)
                            ->first();
        $today = Carbon::now();
        
        return view('attendance.index', [
            'class' => $class,
            'teacher' => $teacher,
            'branch' => $branch,
            'today' => $today,
        ]);
    }

    // function to navigate to view attendance report page
    public function attendanceReport(){
        $teacher = Staffs::where('user_id', Auth::user()->id)
                        ->where('is_Admin', true)
                        ->first();

        $branch = Branch::where('id', $teacher->branch_id)->first();

        $class = TadikaClass::where('branch', $branch->id)->get();

        $today = Carbon::now();

        $attendancePercentages = [];
        $classAttendance = [];

        foreach ($class as $cls){
            $attendance = Attendance::where('date', $today->format('Y-m-d'))
                                    ->where('class_id', $cls->id)
                                    ->get();
            $present = 0;
            foreach ($attendance as $attend){
                if ($attend->status == 1){
                    $present++;
                }
            }

            $attendance_percentage = $cls->total_students > 0 ? ($present / $cls->total_students) * 100 : 0;
            $attendancePercentages[$cls->id] = $attendance_percentage;

            $classAttendance[$cls->id] = [
                'present' => $present,
                'total' => $cls->total_students,
            ];
        }

        return view('attendance.attendance-report', [
            'branch' => $branch,
            'teacher' => $teacher,
            'classes' => $class,   
            'today' => $today->format('d/m/Y'),
            'attendancePercentages' => $attendancePercentages,
            'classAttendance' => $classAttendance,
        ]);
    }

    // function to navigate to attendance report detail page
    public function detailAttendanceReport($classId){

        $class = TadikaClass::where('id', $classId)->first();
        $today = $today = Carbon::now()->month;

        $months = Month::where('id', '<=', $today)->get();

        $attendanceRecords = Attendance::where('class_id', $classId)
                                ->with('student')
                                ->orderBy('date')
                                ->get()
                                ->groupBy(function ($date){
                                    return Carbon::parse($date->date)->format('Y-m');
                                });
        
        $students = Students::where('class_id', $classId)->orderBy('full_name')->get();

        return view('attendance.attendance-report-detail',[
            'class' => $class,
            'months' => $months,
            'attendanceRecords' => $attendanceRecords,
            'students' => $students,
        ]);
    }

    // function to navigate to view class page
    public function studentClass(){

        $admin = User::where('user_type', 1)
                        ->whereHas('staffs', function ($query){
                            $query->where('user_id', Auth::user()->id);
                        })->first();
        
        $teacher = Staffs::where('user_id', Auth::user()->id)->first();

        if($teacher->branch_id == 1){
            $classes = TadikaClass::where('branch', 1)->get();
        } else{
            $classes = TadikaClass::where('branch', 2)->get();
        }

        return view('student.student-class', [
            'classes' => $classes,
            'teacher' => $teacher,
            'admin' => $admin
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

            $view_btn = '<a href="'. route('kelas.kelas_detail', ['classId' => $cls->id]) .'" class="btn btn-info me-3 px-2 pb-1 pt-0" style="background-color: var(--custom-info-color); border:none;"
                                title="Maklumat lanjut">
                                <i class="fas fa-eye text-light mx-1" style="font-size: 10px;"></i>
                            </a>';
            
            $edit_btn = '<button type="button" class="btn btn-primary me-3 px-2 pb-1 pt-0" 
                            title="Kemaskini" onclick="Livewire.emit(\'editClass\', '. $cls->id .')">
                            <i class="fas fa-pen-to-square mx-1" style="font-size: 10px;"></i>
                        </button>';

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

            $view_btn = '<a href="'. route('kelas.kelas_detail', ['classId' => $room->id]) .'" class="btn btn-info me-3 px-2 pb-1 pt-0" style="background-color: var(--custom-info-color); border:none;"
                                title="Maklumat lanjut">
                                <i class="fas fa-eye text-light mx-1" style="font-size: 10px;"></i>
                            </a>';
            
            $edit_btn = '<button type="button" class="btn btn-primary me-3 px-2 pb-1 pt-0" 
                            title="Kemaskini" onclick="Livewire.emit(\'editClass\', '. $room->id .')">
                            <i class="fas fa-pen-to-square mx-1" style="font-size: 10px;"></i>
                        </button>';
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

        return view('student.class-detail', ['class' => $class]);
    }

    public function datatable_student_list(Request $request){
        $students = Students::where('class_id', $request->class_id)->get();

        $student_list = [];

        foreach($students as $student){

            $today = new DateTime();
            $dob = new DateTime($student->dob);
            $diff = $dob->diff($today);
            $age = $today->format('Y') - $dob->format('Y');
            if ($age > 0){
                $age_display = $age . ' Tahun';        
            } else {
                $months = $diff->m;
                $age_display = $months . ' Bulan';
            }

            $delete_btn = '<button type="button" class="btn btn-primary me-3 px-2 pb-1 pt-0" 
                                title="Buang Murid daripada kelas" onclick="removeStudentFromClass('.  $student->id . ');">
                                <i class="fas fa-minus mx-1" style="font-size: 10px;"></i>
                            </button>';

            $student_list[] = [
                'name' => $student->full_name,
                'gender' => $student->gender,
                'age' => $age_display,
                'enroll_date' => $student->enroll_date,
                'action' => $delete_btn
            ];
        }

        return datatables()->of($student_list)->addIndexColumn()->make();
    }

    public function datatable_all_student_list(Request $request){
        
        $class = TadikaClass::findOrFail($request->class_id);

        $students = Students::where('branch_id', $class->branch)
                                ->where('is_active', 1)
                                ->where('class_id', null)
                                ->get();

        $student_list = [];

        foreach ($students as $student){
            $today = new DateTime();
            $dob = new DateTime($student->dob);
            $diff = $dob->diff($today);
            $age = $today->format('Y') - $dob->format('Y');
            if ($age > 0){
                $age_display = $age . ' Tahun';        
            } else {
                $months = $diff->m;
                $age_display = $months . ' Bulan';
            }

            $student_list[] = [
                'name' => $student->full_name,
                'gender' => $student->gender,
                'age' => $age_display,
                'enroll_date' => $student->enroll_date,
                'id' => $student->id
            ];
        }

        return datatables()->of($student_list)->addIndexColumn()->make();
    }

    // function to assign student to class
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

    // function to remove student from class
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
