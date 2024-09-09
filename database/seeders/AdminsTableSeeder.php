<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Seed the admins table.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'nama' => 'Al Jago Banget',
                'username' => 'alphian',
                'email' => 'alphian@google.com',
                'password' => Hash::make('123456'), 
                'foto' => '1725713807_aa.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more sample data as needed
        ]);
    }
}
