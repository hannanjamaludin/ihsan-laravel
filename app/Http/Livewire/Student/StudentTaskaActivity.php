<?php

namespace App\Http\Livewire\Student;

use App\Models\Attendance;
use App\Models\TaskaActivity;
use App\Models\TaskaActivityStudent;
use Livewire\Component;
use Livewire\WithFileUploads;

class StudentTaskaActivity extends Component
{
    use WithFileUploads;

    public $room;
    public $today;
    public $selectedDate;
    public $presentStudents = [];

    public $activity;
    public $media;
    public $studentMedia = [];

    public $existingActivity;
    public $existingStudentMedia = [];

    public function mount($room, $today){
        $this->room = $room;
        $this->selectedDate = $today->format('Y-m-d');

        $this->loadData();
    }

    public function updatedSelectedDate()
    {
        $this->loadData();
    }


    public function loadData(){
        $attendance = Attendance::where('class_id', $this->room->id)
                                ->where('date', $this->selectedDate)
                                ->get();

        if ($attendance->isNotEmpty()) {
            $this->presentStudents = Attendance::where('status', 1)
                                                ->where('date', $this->selectedDate)
                                                ->where('class_id', $this->room->id)
                                                ->with('student')
                                                ->get();
        }

        $this->existingActivity = TaskaActivity::where('room_id', $this->room->id)
                                                ->where('date', $this->selectedDate)
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
            'media' => 'file|mimes:jpg,jpeg,png,gif,mp4,webm,ogg|max:10240',
            'studentMedia.*' => 'file|mimes:jpg,jpeg,png,gif,mp4,webm,ogg|max:10240',
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
                'date' => $this->selectedDate,
                'type' => $mediaType, 
                'path' => $path,
            ]);
        } else { // display the uploaded media if exists
            $taskaActivity = $this->existingActivity;
        }

        foreach ($this->presentStudents as $student){
            if (isset($this->studentMedia[$student->student->id])) {

                $existingStudentMedia = TaskaActivityStudent::where('activity_id', $taskaActivity->id)
                                                            ->where('student_id', $student->student->id)
                                                            ->first();

                if (!$existingStudentMedia){

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
                                ->where('date', $this->selectedDate)
                                ->get();
                    
        $this->loadData();

        return view('livewire.student.student-taska-activity', [
            'presentStudents' => $this->presentStudents,
            'attendance' => $attendance,
            'existingActivity' => $this->existingActivity,
        ]);
    }
}
