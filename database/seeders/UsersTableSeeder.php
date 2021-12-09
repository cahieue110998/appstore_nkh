<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Nguyễn Kim Hiểu',
            'email' => 'cahieue11099812@gmail.com',
            'password' => Hash::make('nguyenkimhieu1109'),
            'role' => 1,
        ]);
    }
}
