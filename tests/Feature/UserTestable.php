<?php

namespace Tests\Feature;

use App\Models\{Role, User};

trait UserTestable
{
    
    public static function userAdmin(): User
    {   
        self::roleSeeder();
        
        return User::factory()->create([ "role_id" => 1 ]); //admin        
    }
    
    public static function userCommon(): User
    {   
        self::roleSeeder();
        
        return User::factory()->create([ "role_id" => 2 ]); //user       
    }
    
    public static function roleSeeder()
    {
        Role::create([
            //"id" => 1       
            "name" => "admin",
            "description" => "Administrator",
            "menu_ids" => [ 1, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13 ],
        ]);
        
        Role::create([
            //"id" => 2
            "name" => "user",
            "description" => "User",
            "menu_ids" => [ 1, 4, 5, 6 ],
        ]);
        
        Role::create([
            //"id" => 3
            "name" => "superadmin",
            "description" => "Super administrator",
            "menu_ids" => [ 1, 4, 5, 6, 7, 8, 9, 11, 12, 13 ],
        ]);
        
        Role::create([
            //"id" => 4
            "name" => "webuser",
            "description" => "Web user",
            "menu_ids" => [ 1, 4, 5, 6 ],
        ]);
        
        return;
    }
}
