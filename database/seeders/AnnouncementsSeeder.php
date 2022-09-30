<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AnnouncementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('announcements')->insert([
            [
                'title' => 'Programs On Thanks Giving Day',
                'content' => 'There will be a lot of good happenings on coming thanks giving day.',
                'start_date' => Carbon::create('2022', '11', '24'),
                'end_date' => Carbon::create('2022', '11', '25'),
                'active' => True,
            ],
            [
                'title' => 'Happy Holidays Neighbor Visiting',
                'content' => 'There will be a number of houses to be visited this coming holiday season.',
                'start_date' => Carbon::create('2022', '09', '03'),
                'end_date' => Carbon::create('2022', '09', '10'),
                'active' => True,
            ],
            [
                'title' => 'Virtual Graduation 2025',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'start_date' => Carbon::create('2022', '12', '25'),
                'end_date' => Carbon::create('2022', '12', '26'),
                'active' => False,
            ],
            [
                'title' => 'Save The Date',
                'content' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'start_date' => Carbon::create('2022', '12', '27'),
                'end_date' => Carbon::create('2022', '12', '28'),
                'active' => True,
            ],
            [
                'title' => 'Neighborhood Rules',
                'content' => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                'start_date' => Carbon::create('2022', '09', '02'),
                'end_date' => Carbon::create('2022', '09', '09'),
                'active' => True,
            ],
            [
                'title' => 'We Are Moving',
                'content' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'start_date' => Carbon::create('2022', '01', '01'),
                'end_date' => Carbon::create('2022', '01', '02'),
                'active' => False,
            ],
            [
                'title' => 'Dress Up Party Brazil',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'start_date' => Carbon::create('2022', '09', '01'),
                'end_date' => Carbon::create('2022', '09', '08'),
                'active' => True,
            ],
            [
                'title' => 'The Marchesis Are Expecting',
                'content' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                'start_date' => Carbon::create('2022', '01', '05'),
                'end_date' => Carbon::create('2022', '01', '06'),
                'active' => True,
            ],
        ]);
    }
}
