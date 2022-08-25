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
        $data = [
            "user_name_surname" => "SIMPLE ADMIN CMS",
            "username" => "admin",
            "user_password" => Hash::make(1)
        ];

        DB::table("users")->insert($data);
    }
}
