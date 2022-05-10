<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Martin',
            'login' => 'user1',
            'email' => 'user1@mail.com',
            'password' => Hash::make('password'),
            'remember_token' => ''
        ]);

        DB::table('users')->insert([
            'name' => 'Administrator',
            'login' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin'),
            'remember_token' => ''
        ]);
    }
}
