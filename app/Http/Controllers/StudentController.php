<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Staffs;
use App\Models\Students;
use App\Models\TadikaActivity;
use App\Models\TadikaClass;
use App\Models\TaskaActivity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    // function for navigating to view student profile page
    public function studentProfile(){
        $students = Students::where('user_id', Auth::user()->id)
                        ->where('is_active', 1)
                        ->with('branch')->get();

        return view('student.student-profile', [
            'students' => $students
        ]);
    }

    // function for navigating to view student details page
    public function profileDetail($studentId){
        $student = Students::where('id', $studentId)
                            ->with('branch')->first();

        return view('student.student-profile-detail', [
            'student' => $student,
        ]);
    }

    // function to navigate to update student profile page
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

    // function to navigate to to student activity page
    public function studentActivity(){

        $teacher = Staffs::where('user_id', Auth::user()->id)
                        ->with('assignedClass')
                        ->first();

        $class = TadikaClass::with('teacher')
                            ->where('id', $teacher->class_room)
                            ->first();
        
        $today = Carbon::now();

        return view('student.student-activity', [
            'teacher' => $teacher,
            'class' => $class,
            'today' => $today
        ]);
    }

    // function to return media file path
    public function preview_file($path){
        $visualPath = storage_path('app/' . $path);

        return response()->file($visualPath);
    }

    // function to navigate to child activity page
    public function childActivity(){
        $students = Students::where('user_id', Auth::user()->id)
                        ->where('is_active', 1)
                        ->with('branch')->get();

        return view('student.child-activity', [
            'students' => $students,
        ]);
    }

    // function to navigate to child activity detail page
    public function activityDetail($studentId){
        $student = Students::where('id', $studentId)
                            ->with('branch', 'assignedClass')->first();

        $teacher = Staffs::where('class_room', $student->class_id)
                            ->first();

        return view('student.child-activity-detail', [
            'student' => $student,
            'teacher' => $teacher,
        ]);
    }

    public function datatable_room_activity(Request $request){
        $activity_list = [];

        $attendances = Attendance::where('student_id', $request->student_id)
                                ->where('status', 1)
                                ->get();

        foreach ($attendances as $attendance){

            $activities = TaskaActivity::where('room_id', $request->room_id)
                                        ->where('date', $attendance->date)
                                        ->with('activityStudent')
                                        ->get();

            
            foreach ($activities as $activity) {

                if ($activity->type == 1){
                    $media_class = '<button type="button" class="btn btn-primary me-3 px-2 pb-1 pt-0" 
                                        title="Papar Gambar" data-id="'. $activity->id .'" data-type="class">
                                        Papar Gambar
                                    </button>';
                } elseif ($activity->type == 2){
                    $media_class = '<button type="button" class="btn btn-primary me-3 px-2 pb-1 pt-0" 
                                        title="Papar Video" data-id="'. $activity->id .'" data-type="class">
                                        Papar Video
                                    </button>';
                } else {
                    $media_class = '';
                }

                if ($activity->activityStudent->isNotEmpty()){
                    
                    $activity_student = $activity->activityStudent->where('student_id', $request->student_id)->first();

                    if ($activity_student) {
                        if ($activity_student->type == 1){
                            $media_student = '<button type="button" class="btn btn-primary me-3 px-2 pb-1 pt-0" 
                                                title="Papar Gambar" data-id="'. $activity_student->id .'" data-type="student">
                                                Papar Gambar
                                            </button>';
                        } elseif ($activity_student->type == 2){
                            $media_student = '<button type="button" class="btn btn-primary me-3 px-2 pb-1 pt-0" 
                                                title="Papar Video" data-id="'. $activity_student->id .'" data-type="student">
                                                Papar Video
                                            </button>';
                        } else {
                            $media_student = '';
                        }
                    } else {
                        $media_student = '';
                    }
                } else {
                    $media_student = '-';
                }

                $activity_list[] = [
                    'date' => $activity->date,
                    'activity' => $activity->activity,
                    'media_class' => $media_class,
                    'media_student' => $media_student,
                ];
            }
        }    

        return datatables()->of($activity_list)->addIndexColumn()->make();
    }

    public function datatable_class_activity(Request $request){
        $activity_list = [];

        $attendances = Attendance::where('student_id', $request->student_id)
                                ->where('status', 1)
                                ->get();
                                
        foreach ($attendances as $attendance){
            $activities = TadikaActivity::where('class_id', $request->class_id)
                                        ->where('date', $attendance->date)
                                        ->with('subjects', 'studentActivity')
                                        ->get();

            foreach ($activities as $activity) {

                $comment = $activity->studentActivity->where('student_id', $request->student_id)->first();

                $activity_list[] = [
                    'date' => $activity->date,
                    'subject' => $activity->subjects->full_name,
                    'learning' => $activity->learning,
                    'activity' => $activity->activity,
                    'comment' => $comment ? $comment->comment : '-',
                ];
            }
        }


        return datatables()->of($activity_list)->addIndexColumn()->make();
    }

}
