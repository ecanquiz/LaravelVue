<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
            "title" => "Dashboard",
            "menu_id" => null,
            "path" => "dashboard",
            "icon" => "dashboard.svg",
            "sort" => 1
        ]);

        Menu::create([
            "title" => "Registrar",
            "menu_id" =>  null,
            "path" => "#",
            "icon" => "dashboard.svg",
            "sort" => 2
        ]);

        Menu::create([
            "title" => "Administración",
            "menu_id" =>  null,
            "path" => "#",
            "icon" => "dashboard.svg",
            "sort" => 3
        ]);

        Menu::create([
            "title" => "Publicaciones",
            "menu_id" =>  2,
            "path" => "posts",
            "icon" => "posts.svg",
            "sort" => 2
        ]);

        Menu::create([
            "title" => "Menús",
            "menu_id" => 3,
            "path" => "menus",
            "icon" => "menus.svg",
            "sort" => 5
        ]);

        Menu::create([
            "title" => "Roles",
            "menu_id" => 3,
            "path" => "roles",
            "icon" => "dashboard.svg",
            "sort" => 6
        ]);

        Menu::create([
            "title" => "Usuarios",
            "menu_id" => 3,
            "path" => "users",
            "icon" => "users.svg",
            "sort" => 7
        ]);

        Menu::create([
            "title" => "Ajustes",
            "menu_id" => 3,
            "path" => "settings",
            "icon" => "settings.svg",
            "sort" => 8
        ]);

    }
}

