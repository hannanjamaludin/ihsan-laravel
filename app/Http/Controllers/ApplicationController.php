<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(){
        return view('application.index');
    }

    public function createApplication(){
        return view('application.create-application');
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
