<?php

namespace App\Http\Livewire\Home;

use App\Models\Application;
use App\Models\Attendance;
use App\Models\Students;
use App\Models\TadikaClass;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StaffHomePage extends Component
{
    public function render()
    {
        $user = User::with('staffs.branch', 'staffs.assignedClass')->findOrFail(Auth::user()->id);

        $students = Students::whereHas('branch', function($query) use ($user) {
                                $query->where('id', $user->staffs->branch_id);
                            })
                            ->whereHas('applicationStatus', function($query){
                                $query->where('status', NULL);
                            })
                            ->with('mom', 'dad', 'branch')
                            ->orderBy('updated_at', 'desc')
                            ->take(3)
                            ->get();

        $boysCount = Students::whereHas('branch', function($query) use ($user) {
                                $query->where('id', $user->staffs->branch_id);
                            })
                            ->where('gender', 'lelaki')
                            ->count();

        $girlsCount = Students::whereHas('branch', function($query) use ($user) {
                                $query->where('id', $user->staffs->branch_id);
                            })
                            ->where('gender', 'perempuan')
                            ->count();

        $acceptedCount = Application::where('branch_id', $user->staffs->branch_id)
                                    ->where('status', 1)
                                    ->count();

        $rejectedCount = Application::where('branch_id', $user->staffs->branch_id)
                                    ->where('status', 0)
                                    ->count();

        $class = TadikaClass::where('branch', $user->staffs->branch_id)->get();

        $today = Carbon::now();

        $attendancePercentages = [];
        $classAttendance = [];

        foreach ($class as $cls){
            $attendance = Attendance::where('date', $today->format('Y-m-d'))
                                    ->where('class_id', $cls->id)
                                    ->get();
            $present = 0;
            foreach ($attendance as $attend){
                if ($attend->status == 1){
                    $present++;
                }
            }

            $attendance_percentage = $cls->total_students > 0 ? ($present / $cls->total_students) * 100 : 0;
            $attendancePercentages[$cls->id] = $attendance_percentage;

            $classAttendance[$cls->id] = [
                'present' => $present,
                'total' => $cls->total_students,
            ];
        }                            

        return view('livewire.home.staff-home-page', [
            'user' => $user,
            'students' => $students,
            'boysCount' => $boysCount,
            'girlsCount' => $girlsCount,
            'acceptedCount' => $acceptedCount,
            'rejectedCount' => $rejectedCount,
            'classes' => $class,   
            'today' => $today->format('d/m/Y'),
            'attendancePercentages' => $attendancePercentages,
            'classAttendance' => $classAttendance,
        ]);
    }
}