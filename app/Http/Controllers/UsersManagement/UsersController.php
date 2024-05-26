<?php

namespace App\Http\Controllers\UsersManagement;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Parents;
use App\Models\Staffs;
use App\Models\Students;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index(){

        $user = User::find(Auth::user()->id);

        $user_role = null;

        if ($user->user_type == 2){
            // $user_role = User::where('id', $user->id)->with('staffs')->first();
            $user_role = User::where('id', $user->id)->with(['staffs.branch', 'staffs.assignedClass'])->first();

        } elseif ($user->user_type == 3){
            $user_role = User::where('id', $user->id)
                            ->whereHas('parents', function($query){
                                $query->where('role_id', 2); // ibu
                            })->first();
        } elseif ($user->user_type == 4){
            $user_role = User::where('id', $user->id)
                            ->whereHas('parents', function($query){
                                $query->where('role_id', 1); // ayah
                            })->first();
        } else {
            $user_role = User::where('id', $user->id)->with('staffs')->first();
        }

        // dd($user, $user_role, $user_role->parents);
        // dd($user_role->staffs->branch, $user_role->staffs->assignedClass);

        return view('user.user-index', [
            'user' => $user_role,
        ]);
    }

    // protected function validator(Request $request){
    //     return $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:8|confirmed', 
    //         'staffID' => 'required|string|min:8',
    //         'user_type' => 'required|integer',
    //     ],[
    //         'password.required' => 'Kata laluan perlu diisi.',
    //         'password.min' => 'Kata laluan mestilah sekurang-kurangnya :min karakter.',
    //         'password.confirmed' => 'Pengesahan kata laluan tidak serasi.',
    //     ]);    
    // }

    public function updateProfile(Request $request){

        // Log::info('Request method: ' . $request->method());
        $user = User::find($request->user_id);
        $user->update([
            'email' => $request->email,
            'staff_no' => $request->staff_no,
        ]);

        if ($request->password){
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        if ($user->user_type == 2){
            
            $staff_admin = $request->is_admin == 1 ? 1 : 0;

            Log::info('Staff Admin: ' . $staff_admin);
            Log::info('Request Admin: ' . $request->is_admin);

            $teacher = Staffs::where('user_id', $user->id)->first();
            $teacher->update([
                'full_name' => $request->full_name,
                'staff_no' => $request->staff_no,
                'phone_no' => $request->phone_no,
                'is_admin' => $staff_admin,
            ]);
        }

        if ($user->user_type == 3){
            $mom = Parents::where('user_id', $user->id)
                            ->where('role_id', 2)
                            ->first();
            $mom->update([
                'full_name' => $request->full_name,
                'staff_no' => $request->staff_no,
                'phone_no' => $request->phone_no,
                'email' => $request->email,
                'staff_no' => $request->staff_no,
            ]);
        }

        if ($user->user_type == 4){
            $dad = Parents::where('user_id', $user->id)
                            ->where('role_id', 1)
                            ->first();
            $dad->update([
                'full_name' => $request->full_name,
                'staff_no' => $request->staff_no,
                'phone_no' => $request->phone_no,
                'email' => $request->email,
                'staff_no' => $request->staff_no,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Profil telah dikemas kini']);
    }

    public function indexAdmin(){
        return view('user.user-admin');
    }

    public function updateUser($id){
        $user = User::find($id);

        // dd($user);

        $user_role = null;

        if ($user->user_type == 3){
            // dd('masuk');
            $user_role = User::where('id', $user->id)
                            ->whereHas('parents', function($query){
                                $query->where('role_id', 2);
                            })->first();
        } elseif ($user->user_type == 4){
            $user_role = User::where('id', $user->id)
                            ->whereHas('parents', function($query){
                                $query->where('role_id', 1);
                            })->first();
            // dd($user_role, $user_role->parents);
        } else {
            $user_role = User::where('id', $user->id)->with('staffs')->first();
        }
        
        return view('user.edit-user', ['user' => $user_role]);

    }

    // public function deleteUser(Request $request) {
    public function deleteUserOld($id) {
        // dd($request->user_id);
        // try {
            // $user = User::findOrFail($request->user_id);
            $user = User::findOrFail($id);
            // $student = Students::where('user_id', $request->user_id)->get();
            $student = Students::where('user_id', $id)->get();
            // $parents = Parents::where('user_id', $request->user_id)->get();
            $parents = Parents::where('user_id', $id)->get();

            // dd($user);
            if ($parents) {
                foreach ($parents as $p) {
                    $p->delete();
                }
            } 

            if ($student) {

                foreach ($student as $s){
                    $s->delete();
                }
            }
            
            if ($user) {
                $user->delete();
    
                return response()->json(['success' => true, 'message' => 'Pengguna telah dibuang']);
            }
             else {
                return response()->json(['success' => false, 'message' => 'Pengguna gagal dibuang']);
            }
        // } catch (\Exception $e) {
        //     return response()->json(['success' => false, 'message' => 'Ralat: ' . $e->getMessage()], 500);
        // }
    }

    public function deleteUser(Request $request) {
        // dd($request->user_id);
        try {
             $user = User::findOrFail($request->user_id);

            if ($user->user_type === 3 || $user->user_type === 4){

                $student = Students::where('user_id', $request->user_id)->get();
                $parents = Parents::where('user_id', $request->user_id)->get();
     
                // dd($user);
                if ($parents) {
                   foreach ($parents as $p) {
                       $p->delete();
                    }
                } 
     
                if ($student) {
                    foreach ($student as $s){
                        $application = Application::where('student_id', $s->id)->first();
                        $application->delete();
                        $s->delete();
                    }
                }
                
            } else {
                $teacher = Staffs::where('user_id', $request->user_id)->first();
                $teacher->delete();
            }

            if ($user) {
                $user->delete();
    
                return response()->json(['success' => true, 'message' => 'Pengguna telah dibuang']);
            }
                else {
                return response()->json(['success' => false, 'message' => 'Pengguna gagal dibuang']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Ralat: ' . $e->getMessage()], 500);
        }
    }

    public function datatable_user_list(){
        $users = User::where('user_type', '!=', 1)->with('staffs', 'parents')->get();

        // dd($users);

        $user_data = [];

        $name = null;
        $user_type = null;
        // $action = null;

        foreach ($users as $user) {
            if ($user->user_type == 2){
                $name = Staffs::where('user_id', $user->id)->first();
                if ($name->branch_id == 1){
                    $user_type = htmlspecialchars_decode('
                                        <div class="badge bg-warning me-3" style="background-color: var(--custom-warning-color);">
                                            Pengasuh
                                        </div>'
                                    );
                    if ($name->is_admin == 1) {
                        $user_type = htmlspecialchars_decode('
                                            <div class="badge bg-warning me-3" style="background-color: var(--custom-warning-color);">
                                                Ketua Pengasuh
                                            </div>'
                                        );
                    }
                } else {
                    $user_type = htmlspecialchars_decode('
                                        <div class="badge bg-warning me-3" style="background-color: var(--custom-warning-color);">
                                            Guru
                                        </div>'
                                    );
                    if ($name->is_admin == 1) {
                        $user_type = htmlspecialchars_decode('
                                            <div class="badge bg-warning me-3" style="background-color: var(--custom-warning-color);">
                                                Guru Besar
                                            </div>'
                                        );
                    }
                
                }
                
                // dd($name);
            }

            if ($user->user_type == 3){
                $name = Parents::where('user_id', $user->id)
                                ->where('role_id', 2)
                                ->first();
                $user_type = htmlspecialchars_decode('
                                    <div class="badge bg-secondary me-3">
                                        Ibu
                                    </div>'
                                );
            }

            if ($user->user_type == 4){
                $name = Parents::where('user_id', $user->id)
                                ->where('role_id', 1)
                                ->first();
                $user_type = htmlspecialchars_decode('
                                    <div class="badge bg-secondary me-3">
                                        Bapa
                                    </div>'
                                );
            }

            $edit_btn = '<a href="'. route('pengguna.kemaskini_pengguna', ['userId' => $user->id]) .'" class="btn btn-info me-3 px-2 pb-1 pt-0" style="background-color: var(--custom-info-color); border:none;"
                                title="Kemaskini pengguna">
                                <i class="fas fa-pen-to-square text-light mx-1" style="font-size: 10px;"></i>
                            </a>';

            // $delete_btn = '<a href="'. route('pengguna.buang_pengguna', ['userId' => $user->id]) .'" class="btn btn-primary me-3 px-2 pb-1 pt-0" 
            //                     title="Buang pengguna">
            //                     <i class="fas fa-trash mx-1" style="font-size: 10px;"></i>
            //                 </a>';

            $delete_btn = '<button type="button" class="btn btn-primary me-3 px-2 pb-1 pt-0" 
                                title="Tolak permohonan" onclick="delete_user('.  $user->id . ');">
                                <i class="fas fa-trash mx-1" style="font-size: 10px;"></i>
                            </button>';

            $user_data[] = [
                'name' => $name->full_name,
                'email' => $user->email,
                'user_type' => $user_type,
                'action' => $edit_btn . $delete_btn,
            ];
        }

        return datatables()->of($user_data)->addIndexColumn()->make();
    }

    public function createUser() {

        // session()->flash('success_message', 'Pengguna berjaya ditambah!');

        return view('user.create-user');
    }

    public function saveNewUser(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', 
            'staffID' => 'required|string|min:8',
            'user_type' => 'required|integer',
        ],[
            'password.required' => 'Kata laluan perlu diisi.',
            'password.min' => 'Kata laluan mestilah sekurang-kurangnya :min karakter.',
            'password.confirmed' => 'Pengesahan kata laluan tidak serasi.',
            'email.unique' => 'E-mel telah berdaftar di dalam sistem',
        ]);    

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'staff_no' => $request->staffID,
            'user_type' => (int)$request->user_type,
        ]);

        $user_type = (int)$request->user_type;

        if ($user_type == 2){
            Staffs::create([
                'user_id' => $user->id,
                'full_name' => $request->name,
                'phone_no' => $request->phoneNo,
                'staff_no' => $request->staffID,
                'branch_id' => 2,
                'is_admin' => 0
            ]);
        }

        if ($user_type == 5){
            Staffs::create([
                'user_id' => $user->id,
                'full_name' => $request->name,
                'phone_no' => $request->phoneNo,
                'staff_no' => $request->staffID,
                'branch_id' => 1,
                'is_admin' => 0
            ]);

            $user->update([
                'user_type' => 2,
            ]);
        }

        if ($user_type == 3){
            Parents::create([
                'user_id' => $user->id,
                'full_name' => $request->name,
                'phone_no' => $request->phoneNo,
                'staff_no' => $request->staffID,
                'email' => $request->email,
                'role_id' => 2
            ]);
        }

        if ($user_type == 4){
            Parents::create([
                'user_id' => $user->id,
                'full_name' => $request->name,
                'phone_no' => $request->phoneNo,
                'staff_no' => $request->staffID,
                'email' => $request->email,
                'role_id' => 1
            ]);
        }

        session()->flash('success_message', 'Pengguna berjaya ditambah!');

        return redirect()->route('pengguna.index_admin');

    }
}
