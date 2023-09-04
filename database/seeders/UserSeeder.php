<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table("users")->insert([
            ["full_name" => "Ceciron O. Alejo III", "username" => "ceciiiron", "email" => "alejo@gmail.com", "password" => bcrypt("admin1234")],
            ["full_name" => "Juan Cruz", "username" => "juancruz", "email" => "juancruz@gmail.com", "password" => bcrypt("admin1234")]
        ]);
    }
}
