<?php

namespace App\Http\Livewire\Components;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    protected $role;
    
    public function render()
    {
        $this->role = User::where('id', Auth::user()->id)->first();

        // dd($this->role);

        return view('livewire.components.sidebar', [
            'role' => $this->role
        ]);
    }
}
