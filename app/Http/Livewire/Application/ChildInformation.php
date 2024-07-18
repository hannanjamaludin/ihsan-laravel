<?php

namespace App\Http\Livewire\Application;

use App\Models\Branch;
use App\Models\District;
use App\Models\State;
use DateTime;
use Livewire\Component;

class ChildInformation extends Component
{
    public $birthdate;
    public $age;
    public $branch;
    public $filteredBranch = null;
    public $states;
    public $district;
    public $selectState;
    public $selectDistrict;

    protected $queryString = ['birthdate', 'selectState', 'selectDistrict'];

    public function render()
    {
        $today = new DateTime();
        $dob = new DateTime($this->birthdate);
        $this->age = $today->format('Y') - $dob->format('Y');

        if ($this->age > 4){
            $this->filteredBranch = [2];
        } else if ($this->age < 4){
            $this->filteredBranch = [1];
        } else {
            $this->filteredBranch = [1, 2];
        }

        $this->branch = Branch::when($this->birthdate != null, function ($query){
                                    $query->whereIn('id', $this->filteredBranch);
                                })
                                ->get();

        $this->states = State::get();

        $this->district = District::
                            when($this->selectState != null, function ($query){
                                $query->whereHas('state', function ($query) {
                                    $query->where('state', trim($this->selectState));
                                });
                            })
                            ->get();
                            
        return view('livewire.application.child-information', [
            'branch' => $this->branch,
            'states' => $this->states,
            'districts' => $this->district
        ]);
    }
}
