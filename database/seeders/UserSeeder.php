<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            'name' => 'Mr : Admin',
            'username' => 'admin007',
            'role_id' => 1,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('11111111'),
            'image' => 'avatar.png',
            'about' => 'Its me the admin',
            'created_at' => '2023-08-19 13:42:26',
            'updated_at' => '2023-08-19 13:42:26',
        ]);
        DB::table('users')->insert([
            'name' => 'Mr : Author',
            'username' => 'author007',
            'role_id' => 2,
            'email' => 'author@gmail.com',
            'password' => Hash::make('11111111'),
            'image' => 'avatar.png',
            'about' => 'Its me the author',
            'created_at' => '2023-08-19 13:42:26',
            'updated_at' => '2023-08-19 13:42:26',
        ]);
    }
}
