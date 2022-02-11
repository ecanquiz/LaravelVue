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

        /*Menu::create([
            "title" => "Jornales",
            "menu_id" =>  2,
            "path" => "journals",
            "icon" => "journals.svg",
            "sort" => 3
        ]);*/

        /*Menu::create([
            "title" => "Tipos de Vivienda",
            "menu_id" => 3,
            "path" => "dwelling-types",
            "icon" => "dwelling-types.svg",
            "sort" => 1
        ]);*/

        /*Menu::create([
            "title" => "Categorías",
            "menu_id" => 3,
            "path" => "categories",
            "icon" => "categories.svg",
            "sort" => 2
        ]);*/

        /*Menu::create([
            "title" => "Tareas",
            "menu_id" => 3,
            "path" => "tasks",
            "icon" => "tasks.svg", "sort" => 3
        ]);*/

        /*Menu::create([
            "title" => "Zonas",
            "menu_id" => 3,
            "path" => "zones",
            "icon" => "zones.svg",
            "sort" => 4
        ]);*/

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

        /*Menu::create([
            "title" => "Ajustes",
            "menu_id" => 3,
            "path" => "settings",
            "icon" => "settings.svg",
            "sort" => 8
        ]);*/        
        
        /*Menu::create([
            "title" => "Viviendas",
            "menu_id" => 2,
            "path" => "dwellings",
            "icon" => "settings.svg",
            "sort" => 3
        ]);*/

        /*Menu::create([
            "title" => "Mensualidades",
            "menu_id" => 2,
            "path" => "monthly-movements",
            "icon" => "settings.svg",
            "sort" => 4
        ]);*/

    }
}

