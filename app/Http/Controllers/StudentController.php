<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Student\StudentTadikaActivity;
use App\Models\Staffs;
use App\Models\Students;
use App\Models\TadikaActivity;
use App\Models\TadikaActivityStudent;
use App\Models\TadikaClass;
use App\Models\TaskaActivity;
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

        return view('student.student-activity', [
            'teacher' => $teacher,
            'class' => $class,
            'today' => $today
        ]);
    }

    public function preview_file($path){
        $visualPath = storage_path('app/' . $path);

        return response()->file($visualPath);
    }

    public function childActivity(){
        $students = Students::where('user_id', Auth::user()->id)
                        ->where('is_active', 1)
                        ->with('branch')->get();

        return view('student.child-activity', [
            'students' => $students,
        ]);
    }

    public function activityDetail($studentId){
        $student = Students::where('id', $studentId)
                            ->with('branch', 'assignedClass')->first();
        // dd($student);

        $teacher = Staffs::where('class_room', $student->class_id)
                            ->first();

        return view('student.child-activity-detail', [
            'student' => $student,
            'teacher' => $teacher,
        ]);
    }

    public function datatable_room_activity(Request $request){
        $activity_list = [];

        $activities = TaskaActivity::where('room_id', $request->room_id)
                                    ->with('activityStudent')
                                    ->get();

        // dd($activities);
        foreach ($activities as $activity) {

            if ($activity->type == 1){
                $media_class = '<button type="button" class="btn btn-primary me-3 px-2 pb-1 pt-0" 
                                    title="Kemaskini" onclick="">
                                    Papar Gambar
                                </button>';
            } elseif ($activity->type == 2){
                $media_class = '<button type="button" class="btn btn-primary me-3 px-2 pb-1 pt-0" 
                                    title="Kemaskini" onclick="">
                                    Papar Video
                                </button>';
            } else {
                $media_class = '';
            }

            if ($activity->activityStudent->isNotEmpty()){
                if ($activity->type == 1){
                    $media_student = '<button type="button" class="btn btn-primary me-3 px-2 pb-1 pt-0" 
                                        title="Kemaskini" onclick="">
                                        Papar Gambar
                                    </button>';
                } elseif ($activity->type == 2){
                    $media_student = '<button type="button" class="btn btn-primary me-3 px-2 pb-1 pt-0" 
                                        title="Kemaskini" onclick="">
                                        Papar Video
                                    </button>';
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
        return datatables()->of($activity_list)->addIndexColumn()->make();
    }

    public function datatable_class_activity(Request $request){
        $activity_list = [];

        $activities = TadikaActivity::where('class_id', $request->class_id)
                                    ->with('subjects', 'studentActivity')
                                    ->get();

        foreach ($activities as $activity) {
            // dd($activity->studentActivity->isNotEmpty());
            $activity_list[] = [
                'date' => $activity->date,
                'subject' => $activity->subjects->full_name,
                'learning' => $activity->learning,
                'activity' => $activity->activity,
                'comment' => $activity->studentActivity->isNotEmpty() ? $activity->studentActivity->comment : '-',

            ];
        }
        return datatables()->of($activity_list)->addIndexColumn()->make();
    }

}
