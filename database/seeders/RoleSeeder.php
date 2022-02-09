<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        Role::create([
            "name" => "admin",
            "description" => "Administrator",
            "menu_ids" => [ 1, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15 ],
        ]);
        
        Role::create([
            "name" => "user",
            "description" => "User",
            "menu_ids" => [ 1, 4, 5, 6, 14, 15 ],
        ]);
        
        Role::create([
            "name" => "superadmin",
            "description" => "Super administrator",
            "menu_ids" => [ 1, 4, 5, 6, 7, 8, 9, 11, 12, 13, 14, 15 ],
        ]);
        
        Role::create([
            "name" => "webuser",
            "description" => "Web user",
            "menu_ids" => [ 1, 4, 5, 6, 14, 15 ],
        ]);
    }
}
