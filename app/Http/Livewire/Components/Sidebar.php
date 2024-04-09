<?php

namespace App\Http\Livewire\Components;

use App\Models\Students;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    protected $role;
    
    public function render()
    {
        $this->role = User::where('id', Auth::user()->id)->first();
        $children = Students::where('user_id', Auth::user()->id)
                            ->where('is_active', 1)->get();

        // dd($this->role, $children);

        return view('livewire.components.sidebar', [
            'role' => $this->role,
            'children' => $children
        ]);
    }
}
