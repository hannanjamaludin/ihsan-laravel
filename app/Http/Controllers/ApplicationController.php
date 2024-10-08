<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Branch;
use App\Models\District;
use App\Models\Parents;
use App\Models\Staffs;
use App\Models\State;
use App\Models\Students;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index(){

        $student_status = Students::where('user_id', Auth::user()->id)
                                ->with('applicationStatus')
                                ->get();
                        
        return view('application.index', ['student' => $student_status]);
    }

    // function to navigate to create new application page
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

        $form_data = session('form_data');

        return view('application.create-application', [
            'dad' => $dad,
            'mom' => $mom,
            'branch' => $branch,
            'form_data' => $form_data,
        ]);
    }

    // function to navigate to next page for create application
    public function createApplicationNext(){

        $branch = Branch::get();

        $form_data = session('form_data');

        return view('application.create-application-next', [
            'form_data' => $form_data,
            'branch' => $branch,
        ]);
    }
    
    // function to store application information in session
    public function storeSession(Request $request){

        $form_data = $request->all(); 
        session()->put('form_data', $form_data);

        return redirect()->route('pendaftaran.pendaftaranBaruFinal');
    }

    // function to store application information in database
    public function store(Request $request){

        try{
            $form_data = session('form_data');

            $userUser = User::findOrFail(Auth::user()->id);
    
            $user = Parents::where('user_id', Auth::user()->id)->first();
    
            $parents = Parents::where('user_id', Auth::user()->id)->get();
    
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
        
            // if user is a mom
            if ($user->role_id == 2){

                $userUser->update([
                    'email' => $form_data['mom_email'],
                    'staff_no' => $form_data['mom_staff_no'],
                ]);

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
    
                // if dad's information is available in database, update the information
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
        
                } else { // if dad's information is not available, create a new one
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
    
            } else { // if user is a dad

                $userUser->update([
                    'email' => $form_data['dad_email'],
                    'staff_no' => $form_data['dad_staff_no'],
                ]);
    
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
    
                // if mom's information is available, update the information
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
                } else { // if mom's information is not available, create a new one
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
                'is_active' => NULL,
                'enroll_date' => $form_data['enroll_date'],
            ]);
    
            $app = Application::create([
                'branch_id' => $student['branch_id'],
                'user_id' => Auth::user()->id,
                'student_id' => $student['id'],
                'verification' => $request->pengakuan
            ]);
    
            $branch = Branch::find($student->branch_id);
    
            // add the application count
            if($branch){
                $branch = $branch->update([
                    'application' => $branch->application + 1,
                ]);
            }
    
            session()->forget('form_data');
            session()->flash('success', 'Pendaftaran berjaya dihantar!');
            
        } catch (\Exception $e){
            session()->flash('error', 'Pendaftaran gagal. Sila cuba lagi.');

        }

        return redirect()->route('pendaftaran.index');

    }

    // function to navigate to update application page
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
                return response()->json(['success' => false, 'message' => 'Pendaftaran gagal dibuang']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Ralat: ' . $e->getMessage()], 500);
        }
    }

    public function datatable_application_list(){

        $user = User::where('id', Auth::user()->id)->first();
        $studentQuery = Students::whereHas('applicationStatus', function($query){
                                $query->where('status', NULL);
                            })->with('mom', 'dad', 'branch');
                            
        if ($user->user_type == 2){
            $teacher = Staffs::where('user_id', $user->id)->first();

            if ($teacher){
                $studentQuery = Students::whereHas('branch', function($query) use ($teacher) {
                                        $query->where('id', $teacher->branch_id);
                                    })->whereHas('applicationStatus', function($query){
                                        $query->where('status', NULL);
                                    })->with('mom', 'dad', 'branch');
            }
        }
        
        $student = $studentQuery->get();
        $al_data = [];

        foreach ($student as $s){

            // calculate age
            $today = new DateTime();
            $dob = new DateTime($s->dob);
            $diff = $dob->diff($today);
            $age = $today->format('Y') - $dob->format('Y');
            if ($age > 0){
                $age_display = $age . ' Tahun';        
            } else {
                $months = $diff->m;
                $age_display = $months . ' Bulan';
            }

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

            $al_data[] = [
                'name' => $s->full_name,
                'age' => $age_display,
                'branch' => $s->branch->branch_name,
                'staff_student' => $staff_student,
                'action' => $info_btn . $accept_btn . $reject_btn,
            ];
        }

        return datatables()->of($al_data)->addIndexColumn()->make();
    }

    public function datatable_updated_application(){

        $user = User::where('id', Auth::user()->id)->first();
        $studentQuery = Students::whereHas('applicationStatus', function($query){
                                        $query->whereIn('status', [0, 1]);
                                    })->with('mom', 'dad', 'branch');
                            
        if ($user->user_type == 2){
            $teacher = Staffs::where('user_id', $user->id)->first();

            if ($teacher){
                $studentQuery = Students::whereHas('applicationStatus', function($query){
                                                $query->whereIn('status', [0, 1]);
                                            })->whereHas('branch', function($query) use ($teacher) {
                                                $query->where('id', $teacher->branch_id);
                                            })->with('mom', 'dad', 'branch');
            }
        }
        
        $student = $studentQuery->get();
        
        $updated_app = [];

        foreach ($student as $s){

            // calculate age
            $today = new DateTime();
            $dob = new DateTime($s->dob);
            $diff = $dob->diff($today);
            $age = $today->format('Y') - $dob->format('Y');
            if ($age > 0){
                $age_display = $age . ' Tahun';        
            } else {
                $months = $diff->m;
                $age_display = $months . ' Bulan';
            }

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
            $assign_class = null;
            
            if ($s->applicationStatus->status == 1) {
                $action_btn = '<div class="badge bg-primary me-3" style="background-color: var(--custom-primary-color);">
                                    Diterima
                                </div>';
            } else {
                $action_btn = '<div class="badge bg-secondary me-3" style="background-color: var(--custom-secondary-color);">
                                    Ditolak
                                </div>';
            }

            $updated_app[] = [
                'name' => $s->full_name,
                'age' => $age_display,
                'branch' => $s->branch->branch_name,
                'staff_student' => $staff_student,
                'updated_at' => $updated_at,
                'action' => $action_btn,
            ];
        }

        return datatables()->of($updated_app)->addIndexColumn()->make();
    }

    public function getDistrict(Request $request){
        $state = State::where('id', $request->id)->first();
        $district = District::whereIn('state_id', $state->id)->pluck('id', 'district');
        
        return response()->json([
            'listDistricts' => $district
        ]);
    }
}
