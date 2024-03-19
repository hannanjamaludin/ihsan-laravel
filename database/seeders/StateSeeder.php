<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::create(['state' => 'Johor']);
        State::create(['state' => 'Kedah']);
        State::create(['state' => 'Kelantan']);
        State::create(['state' => 'Melaka']);
        State::create(['state' => 'Negeri Sembilan']);
        State::create(['state' => 'Pahang']);
        State::create(['state' => 'Perak']);
        State::create(['state' => 'Perlis']);
        State::create(['state' => 'Pulau Pinang']);
        State::create(['state' => 'Sabah']);
        State::create(['state' => 'Sarawak']);
        State::create(['state' => 'Selangor']);
        State::create(['state' => 'Terengganu']);
        State::create(['state' => 'Wilayah Persekutuan Kuala Lumpur']);
        State::create(['state' => 'Wilayah Persekutuan Labuan']);
        State::create(['state' => 'Wilayah Persekutuan Putrajaya']);
    }
}
