<?php

namespace App\Http\Livewire\Application;

use App\Models\Branch;
use App\Models\District;
use App\Models\State;
use Livewire\Component;

class ChildInformation extends Component
{
    public $branch;
    public $states;
    public $district;
    public $selectState;
    public $selectDistrict;

    protected $queryString = ['selectState', 'selectDistrict'];

    // public function mount(){
    //     $this->branch = Branch::get();
    //     $this->states = State::get();
    //     $this->district = District::get();
        
    //     $this->branch = collect();
    //     $this->states = collect();
    //     $this->district = collect();

    // }

    public function render()
    {
        $this->branch = Branch::get();
        $this->states = State::get();

        $this->district = District::
                            when($this->selectState != null, function ($query){
                                $query->whereHas('state', function ($query) {
                                    $query->where('state', trim($this->selectState));
                                });
                            })
                            ->get();
                            
        // dd($this->district);                 

        return view('livewire.application.child-information', [
            'branch' => $this->branch,
            'states' => $this->states,
            'districts' => $this->district
        ]);
    }
}
