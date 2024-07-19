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

    protected $rules = [
        'capacity' => 'required|integer|min:1',
    ];

    public function editClass($id){
        $class = TadikaClass::with('teacher')->findOrFail($id);

        if ($class->teacher->branch_id == 2){
            $this->className = $class->age . ' ' . $class->class_name;
        } else {
            $this->className = $class->class_name;        
        }

        $this->classId = $class->id;        
        $this->teacher = $class->teacher ? $class->teacher->full_name : '-';        
        $this->capacity = $class->capacity;        
        $this->totalStudents = $class->total_students;  
        $this->emit('openModal');      
    }

    public function updateClass(){
        $class = TadikaClass::findOrFail($this->classId);

        $this->validate();
        $class->update([
            'capacity' => $this->capacity,
        ]);

        $this->emit('closeModal');
        $this->emit('classUpdated');
    }

    public function render()
    {
        return view('livewire.staff.edit-class', [
            'class_room' => $this->classId,
        ]);
    }
}
