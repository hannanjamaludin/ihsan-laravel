<?php

namespace App\Http\Livewire\Student;

use App\Models\Attendance;
use App\Models\Subject;
use App\Models\TadikaActivity;
use App\Models\TadikaActivityStudent;
use Carbon\Carbon;
use Livewire\Component;

class StudentTadikaActivity extends Component
{
    public $class;
    public $today;
    public $formattedDate;
    public $presentStudents = [];

    public $subject;
    public $learning;
    public $activity;
    public $student_id;
    public $comment;

    public $tadika_activity;
    public $students = [];

    public function mount($class, $today){
        $this->class = $class;
        $this->formattedDate = $today->format('d/m/Y');
        $this->today = Carbon::createFromFormat('d/m/Y', $this->formattedDate)->format('Y-m-d');

        $this->tadika_activity = TadikaActivity::where('class_id', $this->class->id)
                                                ->where('date', $this->today)
                                                ->first();

        if ($this->tadika_activity) {
            $this->subject = $this->tadika_activity->subject_id;
            $this->learning = $this->tadika_activity->learning;
            $this->activity = $this->tadika_activity->activity;
        }

    }

    public function submitForm(){

        // $this->validate([
        //     'subject' =>'required',
        //     'learning' =>'required',
        //     'activity' =>'required',
        // ]);

        $tadika_activity = TadikaActivity::where('class_id', $this->class->id)
                                            ->where('date', $this->today)
                                            ->first();

        if (!$tadika_activity){

            $tadika_activity = TadikaActivity::create([
                'class_id' => $this->class->id,
                'teacher_id' => $this->class->teacher->id,
                'subject_id' => $this->subject,
                'learning' => $this->learning,
                'activity' => $this->activity,
                'date' => $this->today,
            ]);
        } else {
            $this->subject = $tadika_activity->subject_id;
            $this->learning = $tadika_activity->learning;
            $this->activity = $tadika_activity->activity;
        }

        if ($this->student_id){
            $existingPerformance = TadikaActivityStudent::where('activity_id', $tadika_activity->id)
                                                            ->where('student_id', $this->student_id)
                                                            ->first();

            if (!$existingPerformance){

                TadikaActivityStudent::create([
                    'student_id' => $this->student_id,
                    'activity_id' => $tadika_activity->id,
                    'comment' => $this->comment,
                    'teacher_id' => $tadika_activity->teacher_id,
                ]);

                $this->emit('formSubmitted', 'success', 'Komen murid berjaya disimpan');

            } else {
                session()->flash('message', 'Murid ini sudah diberi komen');
            }
        } else {
            $this->emit('formSubmitted', 'success', 'Aktiviti berjaya disimpan');
        }

        $this->resetForm();
    }

    public function resetForm() {
        $this->student_id = '';
        $this->comment = '';
    }

    public function render(){
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

        $subjects = Subject::get();

        $this->tadika_activity = TadikaActivity::where('class_id', $this->class->id)
                                    ->where('date', $this->today)
                                    ->first();

        if ($this->tadika_activity) {
            $this->students = TadikaActivityStudent::where('activity_id', $this->tadika_activity->id)
                                                    ->with('student')
                                                    ->get();
        }

        return view('livewire.student.student-tadika-activity', [
            'class' => $this->class,
            'formattedDate' => $this->formattedDate,
            'attendance' => $attendance,
            'presentStudents' => $this->presentStudents,
            'subjects' => $subjects,
            'tadika_activity' => $this->tadika_activity,
            'students' => $this->students,
        ]);
    }
}
