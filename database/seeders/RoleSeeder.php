<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Admin',
            'slug' => 'admin',
            'created_at' => '2023-08-19 13:42:26',
            'updated_at' => '2023-08-19 13:42:26',
        ]);
        DB::table('roles')->insert([
            'name' => 'Author',
            'slug' => 'author',
            'created_at' => '2023-08-19 13:42:26',
            'updated_at' => '2023-08-19 13:42:26',
        ]);
    }
}
