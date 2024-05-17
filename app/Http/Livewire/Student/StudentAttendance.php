<?php

namespace App\Http\Livewire\Student;

use App\Models\Students;
use Livewire\Component;

class StudentAttendance extends Component
{
    public $students;
    public $presentStudents = [];

    public function mount(){
        $this->students = Students::where('is_active', true)->get();
    }

    // public function markAttendance($studentId){
    //     if(in_array($studentId, $this->presentStudents)){
    //         $this->presentStudents = array_diff($this->presentStudents, [$studentId]);
    //     } else {
    //         $this->presentStudents[] = $studentId;
    //     }
    // }

    // public function markPresent($studentId)
    // {
    //     if (!in_array($studentId, $this->presentStudents)) {
    //         $this->presentStudents[] = $studentId;
    //     }
    // }

    // public function markAbsent($studentId)
    // {
    //     if (in_array($studentId, $this->presentStudents)) {
    //         $this->presentStudents = array_diff($this->presentStudents, [$studentId]);
    //     }
    // }

    public function render()
    {
        return view('livewire.student.student-attendance');
    }
}
