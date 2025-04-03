<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //ADMIN
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'MIS@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'admin',
                'status' => 'active',
            ],
            //SUPERVISOR
            [
                'name' => 'Supervisor',
                'username' => 'supervisor',
                'email' => 'supervisor@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'supervisor',
                'status' => 'active',
            ],
            //INTERN
            [
                'name' => 'Intern',
                'username' => 'intern',
                'email' => 'intern@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'intern',
                'status' => 'active',
            ]
        ]);
    }
}
