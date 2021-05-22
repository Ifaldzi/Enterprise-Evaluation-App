<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        User::create([
            "name"=>"admin",
            "email" => "admin@admin.com",
            "username"=>"admin",
            "password"=>Hash::make("admin1234"),
            "is_admin"=>1
        ]);
    }
}
