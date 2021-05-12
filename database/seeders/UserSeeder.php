<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            "username"=>"admin",
            "password"=>bcrypt("admin1234"),
            "is_admin"=>1
        ]);
    }
}
