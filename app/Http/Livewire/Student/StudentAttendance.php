<?php

namespace App\Http\Livewire\Student;

use App\Models\Attendance;
use App\Models\Students;
use Livewire\Component;

class StudentAttendance extends Component
{
    public $students;
    public $presentStudents = [];
    public $absentStudents = [];
    public $class;
    public $today;
    public $selectedDate;
    public $branch;

    public function mount($class, $today, $branch)
    {
        $this->class = $class;
        $this->selectedDate = $today->format('Y-m-d');
        $this->branch = $branch;
        $this->loadAttendanceData();
    }

    public function updatedSelectedDate()
    {
        $this->loadAttendanceData();
    }

    public function markPresent($studentId)
    {
        $attendance = Attendance::create([
            'student_id' => $studentId,
            'class_id' => $this->class->id,
            'date' => $this->selectedDate,
            'status' => 1,
        ]);

        if($attendance) {
            $this->loadAttendanceData();
        }
    }

    public function markAbsent($studentId)
    {
        $attendance = Attendance::create([
            'student_id' => $studentId,
            'class_id' => $this->class->id,
            'date' => $this->selectedDate,
            'status' => 0,
        ]);

        if($attendance) {
            $this->loadAttendanceData();
        }
    }

    public function loadAttendanceData(){
        $attendance = Attendance::where('class_id', $this->class->id)
                                ->where('date', $this->selectedDate)
                                ->get();

        if ($attendance->isNotEmpty()) {
            $this->students = Students::where('class_id', $this->class->id)
                        ->whereDoesntHave('attendance', function($query){
                            $query->where('date', $this->selectedDate);
                        })
                        ->orderBy('full_name', 'asc')
                        ->get();

            $this->presentStudents = Attendance::where('status', 1)
                                ->where('date', $this->selectedDate)
                                ->where('class_id', $this->class->id)
                                ->whereHas('student', function ($query){
                                    $query->orderBy('full_name', 'asc');
                                })
                                ->get();
                                
            $this->absentStudents = Attendance::where('status', 0)
                                ->where('date', $this->selectedDate)
                                ->where('class_id', $this->class->id)
                                ->with(['student' => function ($query) {
                                    $query->orderBy('full_name', 'asc'); 
                                }])->get();
        } else {
            $this->students = Students::where('class_id', $this->class->id)->orderBy('full_name', 'asc')->get();
        }

    }

    public function render()
    {
        return view('livewire.student.student-attendance', [
            'students' => $this->students,
            'presentStudents' => $this->presentStudents,
            'absentStudents' => $this->absentStudents,
            'class' => $this->class,
            'branch' => $this->branch,
        ]);
    }
}

?>