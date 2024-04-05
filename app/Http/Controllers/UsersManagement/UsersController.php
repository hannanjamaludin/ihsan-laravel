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
                $user_type = htmlspecialchars_decode('
                                    <div class="badge bg-warning me-3" style="background-color: var(--custom-warning-color);">
                                        Guru
                                    </div>'
                                );
                
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

            $edit_btn = '<a href="'. route('pengguna.kemaskini_pengguna', ['userId' => $user->id]) .'" class="btn btn-warning me-3 px-2 pb-1 pt-0" style="background-color: var(--custom-warning-color); border:none;"
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
        return view('user.create-user');
    }
}
