<?php

namespace App\Http\Livewire\Student;

use App\Models\TaskaActivity;
use App\Models\TaskaActivityStudent;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ActivityMediaModal extends Component
{
    public $activity;
    public $activityStudent;
    public $mediaType;

    protected $listeners = ['viewMedia', 'resetMedia'];

    public function viewMedia($id, $type){
        $this->resetMedia();

        $this->mediaType = $type;
        if ($type == 'class') {
            $this->activity = TaskaActivity::find($id);
        } elseif ($type == 'student') {
            $this->activityStudent = TaskaActivityStudent::with('activity')->find($id);
        }

        // Debug statements
        // if ($type == 'class') {
        //     logger()->info('Class media path: ' . Storage::url($this->activity->path));
        // } elseif ($type == 'student') {
        //     logger()->info('Student media path: ' . Storage::url($this->activityStudent->path));
        // }

        $this->emit('openModal');
    }

    public function resetMedia(){
        $this->activity = null;
        $this->activityStudent = null;
        $this->mediaType = null;
    }

    public function render()
    {
        return view('livewire.student.activity-media-modal');
    }
}
