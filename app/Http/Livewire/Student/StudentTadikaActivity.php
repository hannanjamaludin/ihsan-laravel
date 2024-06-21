<?php

namespace App\Http\Livewire\Student;

use App\Models\Attendance;
use App\Models\Students;
use App\Models\Subject;
use App\Models\TadikaActivity;
use App\Models\TadikaActivityStudent;
use Carbon\Carbon;
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
    public $student_id;
    public $comment;

    public $submitted = false;
    public $submittedActivities = [];

    public function mount($class, $today)
    {
        $this->class = $class;
        $this->formattedDate = $today->format('d/m/Y');
        $this->today = Carbon::createFromFormat('d/m/Y', $this->formattedDate)->format('Y-m-d');
        $this->loadSubmittedActivities();
    }

    public function loadSubmittedActivities(){
        $this->submittedActivities = TadikaActivity::where('class_id', $this->class->id)
                                                    ->where('date', $this->today)
                                                    ->with('subjects')
                                                    ->get();

    }

    public function submitForm(){
        $this->validate([
            'subject' => 'required',
            'learning' => 'required',
            'activity' => 'required',
            'student_id' => 'nullable',
            'comment' => 'nullable',
        ]);

        $class = $this->class;

        $tadika_activity = TadikaActivity::create([
                                'class_id' => $class->id,
                                'teacher_id' => $class->teacher->id,
                                'subject_id' => $this->subject,
                                'learning' => $this->learning,
                                'activity' => $this->activity,
                                'date' => $this->today,
                            ]);

        if ($tadika_activity && $this->student_id != null){
            TadikaActivityStudent::create([
                'student_id' => $this->student_id,
                'activity_id' => $tadika_activity->id,
                'comment' => $this->comment,
                'teacher_id' => $tadika_activity->teacher_id,
            ]);
        }

        $this->submitted = true;
        $this->loadSubmittedActivities();

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
                                                        
        } 
        // else {
        //     $this->students = Students::where('class_id', $this->class->id)->get();
        // }

        $subjects = Subject::get();

        // dd($this->submittedActivities);

        return view('livewire.student.student-tadika-activity', [
            'class' => $this->class,
            'formattedDate' => $this->formattedDate,
            'presentStudents' => $this->presentStudents,
            'subjects' => $subjects,
            'submittedActivities' => $this->submittedActivities,
        ]);
    }
}
