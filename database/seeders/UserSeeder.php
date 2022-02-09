<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        User::factory()->create([
            "email" => "admin@admin.com",
            "password" => Hash::make("asdf"),
            //"role" => "admin",
            "role_id" => 1,
        ]);

        User::factory()->create([
            "email" => "user@user.com",
            "password" => Hash::make("asdf"),
            //"role" => "user",
            "role_id" => 2,
        ]);
        
        User::factory(14)->create();        
    }
}
