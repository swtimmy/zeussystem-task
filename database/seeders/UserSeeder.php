<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

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
            'name' => "timmy (Admin)",
            'email' => "swtimmy9166@gmail.com",
            'password' => Hash::make("password"),
            'role_id' => "1",
        ]);
        DB::table('users')->insert([
            'name' => "Technician user",
            'email' => "technician@gmail.com",
            'password' => Hash::make("password"),
            'role_id' => "2",
        ]);
        DB::table('users')->insert([
            'name' => "Normal user",
            'email' => "regular@gmail.com",
            'password' => Hash::make("password"),
            'role_id' => "3",
        ]);
    }
}
