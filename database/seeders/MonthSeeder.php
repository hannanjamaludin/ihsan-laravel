<?php

namespace Database\Seeders;

use App\Models\Month;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Month::create(['month' => 'Januari']);
        Month::create(['month' => 'Februari']);
        Month::create(['month' => 'Mac']);
        Month::create(['month' => 'April']);
        Month::create(['month' => 'Mei']);
        Month::create(['month' => 'Jun']);
        Month::create(['month' => 'Julai']);
        Month::create(['month' => 'Ogos']);
        Month::create(['month' => 'September']);
        Month::create(['month' => 'Oktober']);
        Month::create(['month' => 'November']);
        Month::create(['month' => 'Disember']);
    }
}
