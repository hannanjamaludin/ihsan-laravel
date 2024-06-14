<?php

namespace App\Http\Livewire\Application;

use App\Models\Application;
use App\Models\Branch;
use App\Models\Parents;
use App\Models\Students;
use DateTime;
use Illuminate\Http\Request;

use Livewire\Component;

class ViewApplication extends Component
{
    public $student;

    // public function mount($student_id = null){
    //     if($student_id){
    //         $this->student = Students::with(['mom', 'dad', 'branch'])->find($student_id);
    //     }
    // }

    public function render()
    {
        // dd($this->student);
        return view('livewire.application.view-application', [
            'student' => $this->student,
        ]);
    }

    // public function displayModal($id)
    // {
    //     $this->studentId = $id;
    //     // Other logic you want to perform
    //     $student = Students::with(['mom', 'dad', 'branch'])
    //                         ->find($this->studentId);
    // }

    public function getStudentDetails(Request $request){

        $this->student = Students::with(['mom', 'dad', 'branch'])
                            ->find($request->student_id);
                            
        // dd($this->student);
        return response()->json($this->student);
    }

    public function updateApplication(Request $request) {
        $this->student = Students::find($request->student_id);
        $application = Application::where('student_id', $request->student_id)->first();
        $branch = Branch::find($this->student->branch_id);

        if ($request->status == 1) {
            $this->student->update([
                'is_active' => 1,
            ]);
            $application->update(['status' => 1]);
            $branch->update([
                'active_students' => $branch->active_students + 1,
                'total_students' => $branch->total_students + 1,
            ]);
        }

        if ($request->status == 0) {
            $this->student->update(['is_active' => 0]);
            $application->update(['status' => 0]);
            $branch->update([
                'rejected_students' => $branch->rejected_students + 1,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Pendaftaran telah dikemas kini']);
    }

}
