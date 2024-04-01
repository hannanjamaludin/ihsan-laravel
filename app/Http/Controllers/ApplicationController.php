<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Branch;
use App\Models\District;
use App\Models\Parents;
use App\Models\State;
use App\Models\Students;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index(){

        $student_status = Students::where('user_id', Auth::user()->id)
                                ->with('applicationStatus')
                                ->get();
                        
        // dd($student_status);

        return view('application.index', ['student' => $student_status]);
    }

    public function createApplication(){

        $branch = Branch::get();
        $parent = Parents::where('user_id', Auth::user()->id)->get();

        $count_parent = 0;
        $mom = null;
        $dad = null;

        foreach ($parent as $index => $p) {
            
            $count_parent++;

            if ($index == 0){
                if($p->role_id == 1){
                    $dad = $p;
                } else {
                    $mom = $p;
                }
            } 
            if ($index == 1) {
                if($p->role_id == 1){
                    $dad = $p;
                } else {
                    $mom = $p;
                }
            }

        }

        // dd($count_parent, $parent, $mom, $dad);

        $form_data = session('form_data');

        return view('application.create-application', [
            'dad' => $dad,
            'mom' => $mom,
            'branch' => $branch,
            'form_data' => $form_data,
        ]);
    }

    public function createApplicationNext(){

        $branch = Branch::get();

        $form_data = session('form_data');
        // dd($form_data);

        return view('application.create-application-next', [
            'form_data' => $form_data,
            'branch' => $branch,
        ]);
    }
    
    public function storeSession(Request $request){
        // dd('masuk');

        $form_data = $request->all(); 
        // dd($form_data);
        session()->put('form_data', $form_data);

        return redirect()->route('pendaftaran.pendaftaranBaruFinal');
    }

    public function store(Request $request){

        $form_data = session('form_data');

        $user = Parents::where('user_id', Auth::user()->id)->first();

        $parents = Parents::where('user_id', Auth::user()->id)->get();
        // dd($parents);

        $mom = null;
        $dad = null;

        $count_parent = 0;
        foreach ($parents as $index => $parent) {
            if ($parent->role_id == 1 || $parent->role_id == 2){
                $count_parent++;
            }

            if ($index == 0){
                if ($user->role_id == 2){
                    $mom = $parent;
                } else {
                    $dad = $parent;
                }
            }

            if ($index == 1){
                if ($user->role_id == 2){
                    $dad = $parent;
                } else {
                    $mom = $parent;
                }
            }
        }

        // dd($parents, $count_parent, $mom, $dad);

        if ($user->role_id == 2){
            $mom = $user->update([
                'full_name' => $form_data['mom_full_name'],
                'email' => $form_data['mom_email'],
                'phone_no' => $form_data['mom_phone_no'],
                'job' => $form_data['mom_job'],
                'staff_no' => $form_data['mom_staff_no'],
                'student_no' => $form_data['mom_student_no'],
                'address' => $form_data['m_office_address'],
                'district' => $form_data['m_office_district'],
                'state' => $form_data['m_office_state'],
                'postcode' => $form_data['m_office_postcode']
            ]);

            if ($count_parent == 2){

                $dad = $dad->update([
                    'full_name' => $form_data['dad_full_name'],
                    'user_id' => Auth::user()->id,
                    'email' => $form_data['dad_email'],
                    'phone_no' => $form_data['dad_phone_no'],
                    'job' => $form_data['dad_job'],
                    'role_id' => 1,
                    'staff_no' => $form_data['dad_staff_no'],
                    'student_no' => $form_data['dad_student_no'],
                    'address' => $form_data['d_office_address'],
                    'district' => $form_data['d_office_district'],
                    'state' => $form_data['d_office_state'],
                    'postcode' => $form_data['d_office_postcode']
                ]);
    
            } else {
                $dad = Parents::create([
                    'full_name' => $form_data['dad_full_name'],
                    'user_id' => Auth::user()->id,
                    'email' => $form_data['dad_email'],
                    'phone_no' => $form_data['dad_phone_no'],
                    'job' => $form_data['dad_job'],
                    'role_id' => 1,
                    'staff_no' => $form_data['dad_staff_no'],
                    'student_no' => $form_data['dad_student_no'],
                    'address' => $form_data['d_office_address'],
                    'district' => $form_data['d_office_district'],
                    'state' => $form_data['d_office_state'],
                    'postcode' => $form_data['d_office_postcode']
                ]);
            }

        } else {

            $dad = $user->update([
                'full_name' => $form_data['dad_full_name'],
                'email' => $form_data['dad_email'],
                'phone_no' => $form_data['dad_phone_no'],
                'job' => $form_data['dad_job'],
                'staff_no' => $form_data['dad_staff_no'],
                'student_no' => $form_data['dad_student_no'],
                'address' => $form_data['d_office_address'],
                'district' => $form_data['d_office_district'],
                'state' => $form_data['d_office_state'],
                'postcode' => $form_data['d_office_postcode']
            ]);

            if ($count_parent == 2){
                $mom = $mom->update([
                    'full_name' => $form_data['mom_full_name'],
                    'user_id' => Auth::user()->id,
                    'email' => $form_data['mom_email'],
                    'phone_no' => $form_data['mom_phone_no'],
                    'job' => $form_data['mom_job'],
                    'role_id' => 2,
                    'staff_no' => $form_data['mom_staff_no'],
                    'student_no' => $form_data['mom_student_no'],
                    'address' => $form_data['m_office_address'],
                    'district' => $form_data['m_office_district'],
                    'state' => $form_data['m_office_state'],
                    'postcode' => $form_data['m_office_postcode']
                ]);
            } else {
                $mom = Parents::create([
                    'full_name' => $form_data['mom_full_name'],
                    'user_id' => Auth::user()->id,
                    'email' => $form_data['mom_email'],
                    'phone_no' => $form_data['mom_phone_no'],
                    'job' => $form_data['mom_job'],
                    'role_id' => 2,
                    'staff_no' => $form_data['mom_staff_no'],
                    'student_no' => $form_data['mom_student_no'],
                    'address' => $form_data['m_office_address'],
                    'district' => $form_data['m_office_district'],
                    'state' => $form_data['m_office_state'],
                    'postcode' => $form_data['m_office_postcode']
                ]);
            }            
        }

        $mom = Parents::where('user_id', Auth::user()->id)
                        ->where('role_id', 2)
                        ->first();

        $dad = Parents::where('user_id', Auth::user()->id)
                        ->where('role_id', 1)
                        ->first();

        // dd($mom, $dad);

        $student = Students::create([
            'full_name' => $form_data['child_full_name'],
            'ic_no' => $form_data['ic_no'],
            'dob' => $form_data['dob'],
            'gender' => $form_data['gender'],
            'siblings' => $form_data['siblings'],
            'illness' => $form_data['illness'],
            'allergy' => $form_data['allergy'],
            'study' => $form_data['study'],
            'disability' => $form_data['disability'],
            'address1' => $form_data['address1'],
            'postcode' => $form_data['postcode'],
            'district' => $form_data['district'],
            'state' => $form_data['state'],
            'branch_id' => $form_data['branch_id'],
            'dad_id' => $dad->id,
            'mom_id' => $mom->id,
            'user_id' => Auth::user()->id,
            'is_active' => 0,
        ]);

        // dd($mom->id);    
        $app = Application::create([
            'branch_id' => $student['branch_id'],
            'user_id' => Auth::user()->id,
            'student_id' => $student['id'],
            'verification' => $request->pengakuan
        ]);

        $branch = Branch::find($student->branch_id);

        if($branch){
            $branch = $branch->update([
                'application' => $branch->application + 1,
            ]);
        }

        session()->forget('form_data');

        return redirect()->route('pendaftaran.index');

    }

    public function updateApplication(){        
        return view('application.update-application');
    }

    public function deleteApplication(Request $request){

        try{
            $student = Students::findOrFail($request->id);
            $branch = Branch::find($student->branch_id);
            $application = Application::where('student_id', $request->id)->first();
    
            if ($application && $student && $branch){
                $application->delete();
                $student->delete();
                $branch->update([
                    'application' => $branch->application - 1,
                ]);
        
                return response()->json(['success' => true, 'message' => 'Pendaftaran telah dibuang']);
            } else {
                return response()->json(['success' => false, 'message' => 'Pendaftaran telah dibuang']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Ralat: ' . $e->getMessage()], 500);
        }
    }

    public function datatable_application_list(){

        $student = Students::whereHas('applicationStatus', function($query){
                                $query->where('status', NULL);
                            })->with('mom', 'dad', 'branch')->get();

        // dd($student);

        $al_data = [];

        foreach ($student as $s){

            // calculate age
            $today = new DateTime();
            $dob = new DateTime($s->dob);
            $age = $dob->diff($today)->y;

            $staff_student = null;

            if($s->mom->staff_no || $s->dad->staff_no){
                $staff_student = htmlspecialchars_decode('
                                    <div class="badge bg-warning me-3" style="background-color: var(--custom-warning-color);">
                                        Staff UTM
                                    </div>'
                                );
            }
            
            if($s->mom->student_no || $s->dad->student_no){
                $staff_student = htmlspecialchars_decode('
                                    <div class="badge bg-warning me-3" style="background-color: var(--custom-warning-color);">
                                        Pelajar UTM
                                    </div>'
                                );
            }

            // add onclick to a function in js
            $info_btn = '<button type="button" class="btn btn-info me-3 px-2 pb-1 pt-0" style="background-color: var(--custom-info-color); border:none;" 
                            title="Maklumat murid" onclick="display_modal('.  $s->id . ');">
                            <i class="fas fa-info text-light mx-2" style="font-size: 10px;"></i>
                        </button>';

            $accept_btn = '<button type="button" class="btn btn-success me-3 px-2 pb-1 pt-0" style="background-color: var(--custom-success-color); border:none;" 
                                title="Terima Permohonan" onclick="update_application('.  $s->id . ', '. 1 .');">
                                <i class="fas fa-check mx-1" style="font-size: 10px;"></i>
                            </button>';

            $reject_btn = '<button type="button" class="btn btn-danger me-3 px-2 pb-1 pt-0" style="background-color: var(--custom-danger-color); border:none;" 
                                title="Tolak permohonan" onclick="update_application('.  $s->id . ', '. 0 .');">
                                <i class="fas fa-times mx-1" style="font-size: 10px;"></i>
                            </button>';

            // dd($today, $dob, $age);

            $al_data[] = [
                'name' => $s->full_name,
                'age' => $age . ' Tahun',
                'branch' => $s->branch->branch_name,
                'staff_student' => $staff_student,
                'action' => $info_btn . $accept_btn . $reject_btn,
            ];
        }

        return datatables()->of($al_data)->addIndexColumn()->make();
    }

    public function datatable_updated_application(){

        $student = Students::whereHas('applicationStatus', function($query){
                                $query->whereIn('status', [0, 1]);
                            })->with('mom', 'dad', 'branch')->get();

        // dd($student);

        $updated_app = [];

        foreach ($student as $s){

            // calculate age
            $today = new DateTime();
            $dob = new DateTime($s->dob);
            $age = $dob->diff($today)->y;

            $staff_student = null;

            if($s->mom->staff_no || $s->dad->staff_no){
                $staff_student = htmlspecialchars_decode('
                                    <div class="badge bg-warning me-3" style="background-color: var(--custom-warning-color);">
                                        Staff UTM
                                    </div>'
                                );
            }
            
            if($s->mom->student_no || $s->dad->student_no){
                $staff_student = htmlspecialchars_decode('
                                    <div class="badge bg-warning me-3" style="background-color: var(--custom-warning-color);">
                                        Pelajar UTM
                                    </div>'
                                );
            }

            $updated_at = $s->applicationStatus->updated_at->format('Y-m-d H:i:s');

            
            if ($s->applicationStatus->status == 1) {
                $action_btn = '<div class="badge bg-primary me-3" style="background-color: var(--custom-primary-color);">
                                    Diterima
                                </div>';
            } else {
                $action_btn = '<div class="badge bg-secondary me-3" style="background-color: var(--custom-secondary-color);">
                                    Ditolak
                                </div>';
            }

            // dd($today, $dob, $age);

            $updated_app[] = [
                'name' => $s->full_name,
                'age' => $age . ' Tahun',
                'branch' => $s->branch->branch_name,
                'staff_student' => $staff_student,
                'updated_at' => $updated_at,
                'action' => $action_btn,
            ];
        }

        return datatables()->of($updated_app)->addIndexColumn()->make();
    }

    // public function getStudentDetails($student_id){
    //     $student = Students::where('id', $student_id);

    //     return $student;
    // }

    public function getDistrict(Request $request){
        $state = State::where('id', $request->id)->first();
        $district = District::whereIn('state_id', $state->id)->pluck('id', 'district');

        // dd($district);
        
        return response()->json([
            'listDistricts' => $district
        ]);
    }
}
