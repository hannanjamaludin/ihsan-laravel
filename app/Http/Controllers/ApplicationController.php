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
}
