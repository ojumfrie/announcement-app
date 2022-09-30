<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Jane Doe Superadmin',
                'email' => 'jane.doe.superadmin@tesmail.com',
                'password' => Hash::make('flexisourceit'),
                'permission' => 1,
                'active' => True,
            ],
            [
                'name' => 'Jane Doe Admin',
                'email' => 'jane.doe.admin@tesmail.com',
                'password' => Hash::make('flexisourceit'),
                'permission' => 2,
                'active' => True,
            ],
            [
                'name' => 'Jane Doe Editor',
                'email' => 'jane.doe.editor@tesmail.com',
                'password' => Hash::make('flexisourceit'),
                'permission' => 3,
                'active' => True,
            ],
            [
                'name' => 'Jane Doe Viewer',
                'email' => 'jane.doe.viewer@tesmail.com',
                'password' => Hash::make('flexisourceit'),
                'permission' => 4,
                'active' => True,
            ],
        ]);
    }
}
