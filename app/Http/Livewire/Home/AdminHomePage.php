<?php

namespace App\Http\Livewire\Home;

use App\Models\TadikaClass;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminHomePage extends Component
{
    public function render()
    {
        $user = User::with('staffs')->findOrFail(Auth::user()->id);
        $users = User::where('user_type', '!=', 1)
                        ->orderBy('updated_at', 'desc')
                        ->with('staffs', 'parents')
                        ->limit(3)
                        ->get();

        $class_room = TadikaClass::get();

        $dadsCount = User::where('user_type', 4)->count();
        $momsCount = User::where('user_type', 3)->count();

        $parent_staff_count = User::whereHas('parents', function ($query) {
                                        $query->where('staff_no', '!=', null);
                                    })->count();

        $parent_student_count = User::whereHas('parents', function ($query) {
                                        $query->where('student_no', '!=', null);
                                    })->count();

        $totalUsers = User::count();
        $dailyActiveUsers = User::activeUsers(1)->count();
        $weeklyActiveUsers = User::activeUsers(7)->count();
        $monthlyActiveUsers = User::activeUsers(30)->count();

        return view('livewire.home.admin-home-page', [
            'user' => $user,
            'users' => $users,
            'class_room' => $class_room,
            'dadsCount' => $dadsCount,
            'momsCount' => $momsCount,
            'parentStaffCount' => $parent_staff_count,
            'parentStudentCount' => $parent_student_count,
            'totalUsers' => $totalUsers,
            'dailyActiveUsers' => $dailyActiveUsers,
            'weeklyActiveUsers' => $weeklyActiveUsers,
            'monthlyActiveUsers' => $monthlyActiveUsers,
        ]);
    }
}
