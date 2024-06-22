<?php

namespace App\Http\Livewire\Student;

use App\Models\Attendance;
use App\Models\TaskaActivity;
use App\Models\TaskaActivityStudent;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class StudentTaskaActivity extends Component
{
    use WithFileUploads;

    public $room;
    public $today;
    public $formattedDate;
    public $presentStudents = [];

    public $activity;
    public $media;
    public $studentMedia = [];

    public $existingActivity;
    public $existingStudentMedia = [];

    public function mount($room, $today){
        $this->room = $room;
        $this->formattedDate = $today->format('d/m/Y');
        $this->today = Carbon::createFromFormat('d/m/Y', $this->formattedDate)->format('Y-m-d');

        $this->loadData();
    }

    public function loadData(){
        $attendance = Attendance::where('class_id', $this->room->id)
                                ->where('date', $this->today)
                                ->get();

        if ($attendance->isNotEmpty()) {
            $this->presentStudents = Attendance::where('status', 1)
                                                ->where('date', $this->today)
                                                ->where('class_id', $this->room->id)
                                                ->with('student')
                                                ->get();
        }

        $this->existingActivity = TaskaActivity::where('room_id', $this->room->id)
                                                ->where('date', $this->today)
                                                ->first();

        foreach ($this->presentStudents as $student) {
            $this->existingStudentMedia[$student->student->id] = TaskaActivityStudent::where('activity_id', optional($this->existingActivity)->id)
                                                                                        ->where('student_id', $student->student->id)
                                                                                        ->first();
        }

        if ($this->existingActivity) {
            $this->activity = $this->existingActivity->activity;
        }    
    }

    public function submitForm(){
        $this->validate([
            'activity' => 'required',
            'media' => 'file',
            'studentMedia.*' => 'file',
        ]);

        if (!$this->existingActivity) {
            // Determine the type of the uploaded media
            $mediaMimeType = $this->media->getMimeType();
            $mediaType = $this->getMediaType($mediaMimeType);
    
            // store the file
            $path = $this->media->store('public/uploads');
    
            $taskaActivity = TaskaActivity::create([
                'room_id' => $this->room->id,
                'teacher_id' => $this->room->teacher->id,
                'activity' => $this->activity,
                'date' => $this->today,
                'type' => $mediaType, 
                'path' => $path,
            ]);
        } else {
            $taskaActivity = $this->existingActivity;
        }

        dd($this->presentStudents);
        foreach ($this->presentStudents as $student){
            dd('masuk foreach');
            if (isset($this->studentMedia[$student->student->id])) {

                dd('masuk isset');
                $existingStudentMedia = TaskaActivityStudent::where('activity_id', $taskaActivity->id)
                                                            ->where('student_id', $student->student->id)
                                                            ->first();

                if (!$existingStudentMedia){
                    dd('masuk no existing');

                    $studentMediaPath = $this->studentMedia[$student->student->id]->store('public/uploads/student');
    
                    $studentMediaMimeType = $this->studentMedia[$student->student->id]->getMimeType();
                    $studentMediaType = $this->getMediaType($studentMediaMimeType);
    
                    TaskaActivityStudent::create([
                        'activity_id' => $taskaActivity->id,
                        'student_id' => $student->student->id,
                        'path' => $studentMediaPath,
                        'type' => $studentMediaType,
                    ]);
                }
            }
        }

        // $this->reset(['activity', 'visual']);
        $this->emit('formSubmitted', 'success', 'Aktiviti murid berjaya disimpan');
    }

    private function getMediaType($mimeType){
        if (str_starts_with($mimeType, 'image/')){
            return 1;
        } elseif (str_starts_with($mimeType, 'video/')){
            return 2;
        } else {
            return 0;
        }
    }

    public function render()
    {
        $attendance = Attendance::where('class_id', $this->room->id)
                                ->where('date', $this->today)
                                ->get();
                    
        $this->loadData();

        return view('livewire.student.student-taska-activity', [
            'presentStudents' => $this->presentStudents,
            'attendance' => $attendance,
            'existingActivity' => $this->existingActivity,
        ]);
    }
}
