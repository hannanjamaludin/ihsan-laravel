<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create(['full_name' => 'Bahasa Melayu', 'short_name' => 'BM']);
        Subject::create(['full_name' => 'Bahasa Inggeris', 'short_name' => 'BI']);
        Subject::create(['full_name' => 'Sains', 'short_name' => 'SC']);
        Subject::create(['full_name' => 'Matematik', 'short_name' => 'MT']);
        Subject::create(['full_name' => 'Pendidikan Agama Islam', 'short_name' => 'PAI']);
    }
}
