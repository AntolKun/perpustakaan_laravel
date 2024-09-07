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
                'nama' => 'Admin One',
                'username' => 'adminone',
                'email' => 'adminone@example.com',
                'password' => Hash::make('password123'), 
                'foto' => 'admin1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Admin Two',
                'username' => 'admintwo',
                'email' => 'admintwo@example.com',
                'password' => Hash::make('password123'), 
                'foto' => 'admin2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more sample data as needed
        ]);
    }
}
