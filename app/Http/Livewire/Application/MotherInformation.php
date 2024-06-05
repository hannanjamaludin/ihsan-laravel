<?php

namespace App\Http\Livewire\Application;

use App\Models\District;
use App\Models\Parents;
use App\Models\State;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MotherInformation extends Component
{
    public $mom;
    public $states;
    public $district;
    public $mOfficeState;
    public $mOfficeDistrict;
    public $initialStaffChecked;
    public $initialStudentChecked;

    protected $queryString = ['mOfficeState', 'mOfficeDistrict'];

    public function mount(){
        $parent = Parents::where('user_id', Auth::user()->id)->get();

        $count_parent = 0;
        $this->mom = null;

        foreach ($parent as $index => $p) {
            
            $count_parent++;

            if ($index == 0){
                if($p->role_id == 2){
                    $this->mom = $p;
                }
            } 
            if ($index == 1) {
                if($p->role_id == 2){
                    $this->mom = $p;
                }
            }
        }

        // if ($this->mom){
            $this->mOfficeState = $this->mom->state ?? '';
            $this->mOfficeDistrict = $this->mom->district ?? '';
        // }

        $this->initialStaffChecked = $this->mom && $this->mom->staff_no !== null;
        $this->initialStudentChecked = $this->mom && $this->mom->student_no !== null;

    }

    public function render()
    {
        $this->states = State::get();

        $this->district = District::
                            when($this->mOfficeState != null, function ($query){
                                $query->whereHas('state', function ($query) {
                                    $query->where('state', trim($this->mOfficeState));
                                });
                            })
                            ->get();

        return view('livewire.application.mother-information', [
            'mom' => $this->mom,
            'states' => $this->states,
            'districts' => $this->district
        ]);
    }

    public function addInputBox($id){
        if ($id == 'staffRadioButton_mom'){
            $this->dispatchBrowserEvent('displayMomStaff');
        } else {
            // dd($id);
            $this->dispatchBrowserEvent('displayMomStudent');
        }
    }

    public function removeInputBox(){
        $this->dispatchBrowserEvent('hideInputBox');
    }
}
