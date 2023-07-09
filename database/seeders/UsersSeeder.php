<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            [
                'name' => 'Super Admin',
                'email' => 'super_admin@gmail.com',
                'password' => Hash::make('super_admin'),
                'role' => 'super_admin'
            ],
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'role' => 'admin'
            ],
            [
                'name' => 'konter',
                'email' => 'konter@gmail.com',
                'password' => Hash::make('konter'),
                'role' => 'konter'
            ],
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user'),
                'role' => 'user'
            ],
        ];

        DB::table('users')->insert($data);
    }
}
