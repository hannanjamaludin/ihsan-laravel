<?php

namespace App\Http\Livewire\Student;

use App\Models\Attendance;
use App\Models\Staffs;
use App\Models\Students;
use App\Models\Subject;
use App\Models\TadikaActivity;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentTadikaActivity extends Component
{
    public $students;
    public $presentStudents = [];
    public $class;
    public $today;
    public $formattedDate;
    public $branch;

    // form fields
    public $subject;
    public $learning;
    public $activity;
    public $student_name;
    public $comment;

    public $submitted = false;

    public function mount($class, $today)
    {
        $this->class = $class;
        $this->formattedDate = $today->format('d/m/Y');
        $this->today = Carbon::createFromFormat('d/m/Y', $this->formattedDate)->format('Y-m-d');
    }

    public function submitForm(){
        $this->validate([
            'subject' => 'required',
            'learning' => 'required',
            'activity' => 'required',
            'student_name' => 'nullable',
            'comment' => 'nullable',
        ]);

        $class = $this->class;

        TadikaActivity::create([
            'class_id' => $class->id,
            'teacher_id' => $class->teacher->id,
            'subject_id' => $this->subject,
            'learning' => $this->learning,
            'activity' => $this->activity,
            'date' => $this->today,
        ]);

        $this->submitted = true;

        // Emit event for sweetAlert
        $this->emit('formSubmitted');
    }

    public function render()
    {
        $attendance = Attendance::where('class_id', $this->class->id)
                            ->where('date', $this->today)
                            ->get();
         
        if ($attendance->isNotEmpty()) {

            $this->presentStudents = Attendance::where('status', 1)
                                        ->where('date', $this->today)
                                        ->where('class_id', $this->class->id)
                                        ->with('student')
                                        ->get();
                                                        
        } else {
            $this->students = Students::where('class_id', $this->class->id)->get();
        }

        $subjects = Subject::get();

        return view('livewire.student.student-tadika-activity', [
            'class' => $this->class,
            'formattedDate' => $this->formattedDate,
            'presentStudents' => $this->presentStudents,
            'subjects' => $subjects
        ]);
    }
}
