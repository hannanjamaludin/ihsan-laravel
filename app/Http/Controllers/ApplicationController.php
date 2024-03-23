<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Branch;
use App\Models\District;
use App\Models\Parents;
use App\Models\State;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index(){
        return view('application.index');
    }

    public function createApplication(){

        $states = State::get();
        $district = District::get();
        $branch = Branch::get();

        // dd($district);

        return view('application.create-application', [
            'states' => $states,
            'districts' => $district,
            'branch' => $branch
        ]);
    }

    public function createApplicationNext(){

        $form_data = session('form_data');
        // dd($form_data);

        return view('application.create-application-next', ['form_data' => $form_data]);
    }
    
    public function storeSession(Request $request){
        // dd('masuk');

        $form_data = $request->all(); 
        // dd($form_data);
        session()->put('form_data', $form_data);

        return redirect()->route('pendaftaran.pendaftaranBaruFinal');
    }

    public function store(){

        $form_data = session('form_data');

        $student = Students::create([
            'full_name' => $form_data['full_name'],
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
            'parent_id' => Auth::user()->id,
            'is_active' => 0,
        ]);
    
        $app = Application::create([
            'branch_id' => $student['branch_id'],
            'user_id' => Auth::user()->id,
            'student_id' => $student['id'],
            'status' => 0,
        ]);
    
        $mom = Parents::create([
            'full_name' => $form_data['mom_full_name'],
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
    
        $dad = Parents::create([
            'full_name' => $form_data['dad_full_name'],
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

        session()->forget('form_data');

    }

    public function updateApplication(){
        return view('application.update-application');
    }

    public function datatable_application_list(){
        $al_data = [];

        $al_data[] = [
            'name' => 'Lisa Sofea binti Mohammad Aqeel',
            'age' => '4 Tahun',
            'branch' => 'Tadika Ihsan',
            'staff_student' => htmlspecialchars_decode('<div class="badge bg-warning me-3" style="background-color: var(--custom-warning-color);">Staff UTM</div>'),
            'action' => htmlspecialchars_decode('<button type="button" class="btn btn-info rounded-circle me-3 px-3" style="background-color: var(--custom-info-color); border:none;" 
                                                    title="Maklumat murid" data-bs-toggle="modal" data-bs-target="#modalStudentDetails">
                                                    <i class="fas fa-info text-light"></i>
                                                </button>'),
        ];

        return datatables()->of($al_data)->addIndexColumn()->make();
    }
}
