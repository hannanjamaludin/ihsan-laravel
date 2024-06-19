<?php

namespace Database\Seeders;

use App\Models\Staffs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Staffs::create([
            'user_id' => 1,
            'staff_no' => 'UTM180032',
            'full_name' => 'Rahmawatulhusna binti Sokhipul Hadi',
            'ic_no' => "920508-01-3288",
            'phone_no' => "0179975427",
            'branch_id' => null,
            'class_room' => null,
            'is_admin' => 0,
        ]);
    }
}
