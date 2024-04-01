<?php

namespace App\Http\Controllers\UsersManagement;

use App\Http\Controllers\Controller;
use App\Models\Parents;
use App\Models\Staffs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index(){

        $user = User::find(Auth::user()->id);

        $user_role = null;

        if ($user->user_type == 2){
            $user_role = User::where('id', $user->id)->with('staffs')->first();
        } elseif ($user->user_type == 3){
            $user_role = User::where('id', $user->id)
                            ->whereHas('parents', function($query){
                                $query->where('role_id', 2);
                            })->first();
        } elseif ($user->user_type == 2){
            $user_role = User::where('id', $user->id)
                            ->whereHas('parents', function($query){
                                $query->where('role_id', 1);
                            })->first();
        } else {
            $user_role = User::where('id', $user->id)->with('staffs')->first();
        }

        // dd($user, $user_role, $user_role->parents);

        return view('user.user-index', [
            'user' => $user_role,
        ]);
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function updateProfile(Request $request){
    // public function updateProfile(Request $request){
        $user = User::find($request->user_id);

        // dd($request->all());

        if ($request->password){
            // dd('masuk password');
            $user->update([
                'password' => Hash::make($request->password),
                // 'password' => $request->password,
            ]);
        }

        if ($user->user_type == 2){
            $teacher = Staffs::where('user_id', $user->id)->first();
            $teacher->update([
                'phone_no' => $request->phone_no,
            ]);
        }

        if ($user->user_type == 3){
            $mom = Parents::where('user_id', $user->id)
                            ->where('role_id', 2)
                            ->first();
            $mom->update([
                'phone_no' => $request->phone_no,
            ]);
        }

        if ($user->user_type == 4){
            $dad = Parents::where('user_id', $user->id)
                            ->where('role_id', 1)
                            ->first();
            $dad->update([
                'phone_no' => $request->phone_no,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Profil telah dikemas kini']);
    }

    public function indexAdmin(){
        return view('user.user-admin');
    }

    public function updateUser(){

    }

    public function datatable_user_list(){
        $users = User::where('user_type', '!=', 1)->with('staffs', 'parents')->get();

        $user_data = [];

        $name = null;
        $user_type = null;
        $action = null;

        foreach ($users as $user) {
            if ($user->user_type == 2){
                $name = Staffs::where('user_id', $user->id)->first();
                $user_type = htmlspecialchars_decode('
                                    <div class="badge bg-warning me-3" style="background-color: var(--custom-warning-color);">
                                        Guru
                                    </div>'
                                );
            }

            if ($user->user_type == 3){
                $name = Parents::where('user_id', $user->id)
                                ->where('role_id', 2)
                                ->first();
                $user_type = htmlspecialchars_decode('
                                    <div class="badge bg-primary me-3">
                                        Ibu
                                    </div>'
                                );
            }

            if ($user->user_type == 4){
                $name = Parents::where('user_id', $user->id)
                                ->where('role_id', 1)
                                ->first();
                $user_type = htmlspecialchars_decode('
                                    <div class="badge bg-primary me-3">
                                        Bapa
                                    </div>'
                                );
            }

            $user_data[] = [
                'name' => $name->full_name,
                'email' => $user->email,
                'user_type' => $user_type,
                'action' => $action,
            ];
        }

        return datatables()->of($user_data)->addIndexColumn()->make();
    }
}
