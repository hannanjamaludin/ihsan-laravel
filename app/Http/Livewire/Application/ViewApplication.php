<?php

namespace App\Http\Livewire\Application;

use App\Models\Parents;
use App\Models\Students;
use DateTime;
use Illuminate\Http\Request;

use Livewire\Component;

class ViewApplication extends Component
{
    public function render()
    {
        // $student = Students::where('');

        return view('livewire.application.view-application');
    }

    // public function datatable_application_list(){

    //     $student = Students::whereHas('applicationStatus', function($query){
    //                             $query->where('status', 0);
    //                         })->with('mom', 'dad', 'branch')->get();

    //     // dd($student);

    //     $al_data = [];

    //     foreach ($student as $s){

    //         // calculate age
    //         $today = new DateTime();
    //         $dob = new DateTime($s->dob);
    //         $age = $dob->diff($today)->y;

    //         $staff_student = null;

    //         if($s->mom->staff_no || $s->dad->staff_no){
    //             $staff_student = htmlspecialchars_decode('
    //                                 <div class="badge bg-warning me-3" style="background-color: var(--custom-warning-color);">
    //                                     Staff UTM
    //                                 </div>'
    //                             );
    //         }
            
    //         if($s->mom->student_no || $s->dad->student_no){
    //             $staff_student = htmlspecialchars_decode('
    //                                 <div class="badge bg-warning me-3" style="background-color: var(--custom-warning-color);">
    //                                     Pelajar UTM
    //                                 </div>'
    //                             );
    //         }

    //         // add onclick to a function in js
    //         $info_btn = '<button type="button" class="btn btn-info me-3 px-2 pb-1 pt-0" style="background-color: var(--custom-info-color); border:none;" 
    //                         title="Maklumat murid" onclick="display_modal('.  $s->id . ');">
    //                         <i class="fas fa-info text-light mx-1" style="font-size: 10px;"></i>
    //                     </button>';

    //         $accept_btn = '<button type="button" class="btn btn-success me-3 px-2 pb-1 pt-0" style="background-color: var(--custom-success-color); border:none;" 
    //                             title="Terima Permohonan">
    //                             <i class="fas fa-check mx-1" style="font-size: 10px;"></i>
    //                         </button>';

    //         $reject_btn = '<button type="button" class="btn btn-danger me-3 px-2 pb-1 pt-0" style="background-color: var(--custom-danger-color); border:none;" 
    //                             title="Tolak permohonan">
    //                             <i class="fas fa-times mx-1" style="font-size: 10px;"></i>
    //                         </button>';

    //         // dd($today, $dob, $age);

    //         $al_data[] = [
    //             'name' => $s->full_name,
    //             'age' => $age . ' Tahun',
    //             'branch' => $s->branch->branch_name,
    //             'staff_student' => $staff_student,
    //             'action' => $info_btn . $accept_btn . $reject_btn,
    //         ];
    //     }

    //     return datatables()->of($al_data)->addIndexColumn()->make();
    // }

    // public function getStudentDetails($student_id){
    //     $student = Students::where('id', $student_id);

    //     return $student;
    // }

    public function getStudentDetails(Request $request){
        // $student = Students::find($request->student_id);

        $student = Students::with(['mom', 'dad', 'branch'])
                            ->find($request->student_id);

        // $student = Students::where('id', $request->student_id)
        //                     ->whereHas('applicationStatus', function($query){
        //                         $query->where('status', 0);
        //                     })->with('mom', 'dad', 'branch')->get();
                            
        return response()->json($student);
    }

}
