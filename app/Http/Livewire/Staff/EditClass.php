<?php

namespace App\Http\Livewire\Staff;

use App\Models\TadikaClass;
use Livewire\Component;

class EditClass extends Component
{

    public $classId;
    public $className;
    public $teacher;
    public $capacity;
    public $totalStudents;

    protected $listeners = ['editClass'];

    public function editClass($id){
        $class = TadikaClass::with('teacher')->findOrFail($id);
        // dd($class);
        $this->classId = $class->id;        
        $this->className = $class->class_name;        
        $this->teacher = $class->teacher ? $class->teacher->full_name : '-';        
        $this->capacity = $class->capacity;        
        $this->totalStudents = $class->total_students;  
        $this->emit('openModal');      
    }

    public function updateClass(){
        $class = TadikaClass::findOrFail($this->classId);
        $class->update([
            'capacity' => $this->capacity,
        ]);

        $this->emit('closeModal');
    }

    public function render()
    {
        return view('livewire.staff.edit-class');
    }
}
