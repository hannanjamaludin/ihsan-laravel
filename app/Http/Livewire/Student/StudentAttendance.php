<?php

namespace App\Http\Livewire\Student;

use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Staffs;
use App\Models\Students;
use App\Models\TadikaClass;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentAttendance extends Component
{
    public $students;
    public $presentStudents = [];
    public $absentStudents = [];
    public $class;
    public $today;
    public $formattedDate;
    public $branch;

    public function mount($class, $today, $branch)
    {
        // dd($this->today);
        $this->class = $class;
        $this->formattedDate = $today->format('d/m/Y');
        $this->today = Carbon::createFromFormat('d/m/Y', $this->formattedDate)->format('Y-m-d');
        // $this->students = Students::where('class_id', $this->class->id)->get();
    }

    public function markPresent($studentId)
    {
        $attendance = Attendance::create([
            'student_id' => $studentId,
            'class_id' => $this->class->id,
            'date' => $this->today,
            'status' => 1,
        ]);

        if($attendance) {
            // dd('masuk');
            $student = $this->students->where('id', $studentId)->first();
            $this->presentStudents[] = $student;
        }

        // dd($formattedDate, $attendance, $this->presentStudents);
    }

    public function markAbsent($studentId)
    {
        $attendance = Attendance::create([
            'student_id' => $studentId,
            'class_id' => $this->class->id,
            'date' => $this->today,
            'status' => 0,
        ]);

        if($attendance) {
            // dd('masuk');
            $student = $this->students->where('id', $studentId)->first();
            $this->absentStudents[] = $student;
        }

        // $student = $this->students->firstWhere('id', $studentId);
        // if ($student) {
        //     $this->absentStudents[] = $student;
        //     $this->students = $this->students->filter(fn($s) => $s->id !== $studentId)->values();
        // }
    }

    public function render()
    {
        $attendance = Attendance::where('class_id', $this->class->id)
                            ->where('date', $this->today)
                            ->get();
 
        // dd($attendance);
        
        if ($attendance->isNotEmpty()) {
            // dd('masuk');
            $this->students = Students::where('class_id', $this->class->id)
                                ->whereDoesntHave('attendance', function($query){
                                    $query->where('date', $this->today);
                                })->get();

            $this->presentStudents = Attendance::where('status', 1)
                                        ->where('date', $this->today)
                                        ->where('class_id', $this->class->id)
                                        ->with('student')
                                        ->get();
                                        
            $this->absentStudents = Attendance::where('status', 0)
                                        ->where('date', $this->today)
                                        ->where('class_id', $this->class->id)
                                        ->with('student')
                                        ->get();
                
        } else {
            $this->students = Students::where('class_id', $this->class->id)->get();
        }

        // dd($this->students, $this->presentStudents, $this->absentStudents);

        // dd($this->branch);

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