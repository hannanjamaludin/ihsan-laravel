<?php

namespace App\Http\Controllers;

use App\Models\Staffs;
use App\Models\TadikaClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function index(){
        $teacher = Staffs::where('user_id', Auth::user()->id)->first();

        if($teacher->branch_id == 1){
            $classes = TadikaClass::where('branch', 1)->get();
        } else{
            $classes = TadikaClass::where('branch', 2)->get();
        }

        return view('staff.index', [
            'classes' => $classes,
            'teacher' => $teacher
        ]);
    }

    public function datatable_teacher_list(Request $request) {
        $teachers = Staffs::where('branch_id', $request->branch_id)->with('assignedClass')->get();
    
        $teacher_list = [];
        foreach ($teachers as $teacher) {
            if ($request->branch_id == 1) {
                $class_room = $teacher->assignedClass ? $teacher->assignedClass->class_name : '-';
            } else {
                $class_room = $teacher->assignedClass ? $teacher->assignedClass->age . ' ' . $teacher->assignedClass->class_name : '-';
            }
    
            $edit_btn = '<button type="button" class="btn btn-primary me-3 px-2 pb-1 pt-0" 
                                title="Kemaskini" onclick="editTeacherClass('.  $teacher->id . ');">
                                <i class="fas fa-pen-to-square mx-1" style="font-size: 10px;"></i>
                            </button>';
    
            $teacher_list[] = [
                'name' => $teacher->full_name,
                'staff_no' => $teacher->staff_no,
                'phone_no' => $teacher->phone_no,
                'room_class' => $class_room,
                'action' => $edit_btn
            ];
        }
    
        return datatables()->of($teacher_list)->addIndexColumn()->make();
    }

    public function datatable_class_list(Request $request){

        $teacher_class = Staffs::findOrFail($request->teacher_id)->class_room;

        $classes = TadikaClass::where('branch', $request->branch_id)->where('id', '!=', $teacher_class)->get();

        $class_list = [];

        foreach($classes as $class){

            $class_room = $class->class_name;
            if ($request->branch_id == 2) {
                $class_room = $class->age . ' ' . $class->class_name;
            }

            $edit_btn = '<button type="button" class="btn btn-primary me-3 px-2 pb-1 pt-0" 
                                title="Tetapkan Kelas Baharu" onclick="assignNewClass('. $class->id . ', ' . $request->teacher_id . ');">
                                <i class="fas fa-plus mx-1" style="font-size: 10px;"></i>
                            </button>';


            $class_list[] = [
                'class_room' => $class_room,
                'capacity' => $class->capacity,
                'total_students' => $class->total_students,
                'action' => $edit_btn
            ];
        }

        return datatables()->of($class_list)->addIndexColumn()->make();
    }

    public function assignNewClass(Request $request){
        $class_id = $request->class_id;
        $teacher_id = $request->teacher_id;

        $teacher = Staffs::findOrFail($teacher_id);

        // dd($class_id, $teacher_id);

        $teacher->update([
            'class_room' => $class_id
        ]);

        // dd($teacher);

        return response()->json(['success' => 'Kelas baharu telah ditetapkan ' . $class_id]);

    }
}
