<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\TadikaClass;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){

        $tadika = Branch::where('id', 2)->first();
        $taska = Branch::where('id', 1)->first();

        $tadika_classes = TadikaClass::where('branch', 2)->get();
        $taska_rooms = TadikaClass::where('branch', 1)->get();

        $tadika_capacity = 0;
        $taska_capacity = 0;

        foreach ($tadika_classes as $class){
            $tadika_capacity = $tadika_capacity + $class->capacity;
        }

        foreach ($taska_rooms as $room){
            $taska_capacity = $taska_capacity + $room->capacity;
        }

        // dd($tadika_capacity, $taska_capacity);

        return view('welcome', [
            'taska' => $taska,
            'tadika' =>$tadika,
            'taska_capacity' => $taska_capacity,
            'tadika_capacity' => $tadika_capacity
        ]);
    }
}
