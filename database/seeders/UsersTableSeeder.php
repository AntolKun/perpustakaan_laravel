<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'antol',
            'email' => 'antol@gmail.com',
            'nisn' => '22421057',
            'kelas' => '10 IPS 3',
            'password' => Hash::make('password'),
        ]);
    }
}

