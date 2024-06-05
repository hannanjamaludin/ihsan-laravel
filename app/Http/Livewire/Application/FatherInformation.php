<?php

namespace App\Http\Livewire\Application;

use App\Models\District;
use App\Models\Parents;
use App\Models\State;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FatherInformation extends Component
{
    public $dad;
    public $states;
    public $district;
    public $dOfficeState;
    public $dOfficeDistrict;
    public $initialStaffChecked;
    public $initialStudentChecked;

    protected $queryString = ['dOfficeState', 'dOfficeDistrict'];
    
    public function mount()
    {
        $parent = Parents::where('user_id', Auth::user()->id)->get();

        $count_parent = 0;
        $this->dad = null;

        foreach ($parent as $index => $p) {
            
            $count_parent++;

            if ($index == 0){
                if($p->role_id == 1){
                    $this->dad = $p;
                }
            } 
            if ($index == 1) {
                if($p->role_id == 1){
                    $this->dad = $p;
                }
            }
        }

        // dd($this->dad);
        // if ($this->dad){
        $this->dOfficeState = $this->dad->state ?? '';
        $this->dOfficeDistrict = $this->dad->district ?? '';
        // }

        $this->initialStaffChecked = $this->dad && $this->dad->staff_no !== null;
        $this->initialStudentChecked = $this->dad && $this->dad->student_no !== null;

    }

    public function render()
    {
        $this->states = State::get();

        $this->district = District::
                            when($this->dOfficeState != null, function ($query){
                                $query->whereHas('state', function ($query) {
                                    $query->where('state', trim($this->dOfficeState));
                                });
                            })
                            ->get();

        // dd($this->dad->state);
        // foreach ($this->states as $state){
        //     if ($this->dad !== null && $this->dad->state === $state->id){
        //         dd($this->dad->state, $state->id);
        //     }
        // }

        return view('livewire.application.father-information', [
            'dad' => $this->dad,
            'states' => $this->states,
            'districts' => $this->district

        ]);
    }

    public function addInputBox($id){
        // dd($id);
        if ($id == 'staffRadioButton_dad'){
            $this->dispatchBrowserEvent('displayDadStaff');
        } else {
            $this->dispatchBrowserEvent('displayDadStudent');
        }
    }

    public function removeInputBox(){
        $this->dispatchBrowserEvent('hideInputBoxDad');
    }

}
