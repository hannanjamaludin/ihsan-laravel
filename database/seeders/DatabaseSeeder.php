<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(UsersDummySeeder::class);
        $this->call(StaffSeeder::class);
        $this->call(StateSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(BranchSeeder::class);
        $this->call(MonthSeeder::class);
        $this->call(ClassSeeder::class);
        $this->call(SubjectSeeder::class);
    }
}
