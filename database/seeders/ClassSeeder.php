<?php

namespace Database\Seeders;

use App\Models\TadikaClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TadikaClass::create(['age' => 4, 'class_name' => 'Al-Kindi', 'capacity' => 15, 'total_students' => 0]);
        TadikaClass::create(['age' => 5, 'class_name' => 'Ibnu Sina', 'capacity' => 15, 'total_students' => 0]);
        TadikaClass::create(['age' => 5, 'class_name' => 'Al-Ghazali', 'capacity' => 16, 'total_students' => 0]);
        TadikaClass::create(['age' => 6, 'class_name' => 'Ar-Razi', 'capacity' => 15, 'total_students' => 0]);
        TadikaClass::create(['age' => 6, 'class_name' => 'Al-Farabi', 'capacity' => 16, 'total_students' => 0]);
    }
}
