<?php

namespace Tests\Unit;

trait MenuListTestable
{
    
    private function _providedArgumentArray(): Array
    {
        return (array)[
            (object)[
                "id" => 1,
                "title" => "Dashboard",
                "path" => "dashboard",
                "sort" => 1,
                "menu_id" => null,
                "children_menus" => (array)[]
            ], (object)[
                "id" => 2,
                "title" => "Registers",
                "path" => "#",
                "sort" => 2,
                "menu_id" => null,
                "children_menus" => (array)[
                    (object)[
                        "id" => 4,
                        "title" => "Posts",
                        "path" => "posts.index",
                        "sort" => 1,
                        "menu_id" => 2,
                        "children_menus" => (array)[]
                    ]
                ]
            ], (object) [
                "id" => 3,
                "title" => "Admin.",
                "path" => "#",
                "sort" => 3,
                "menu_id" => null,
                "children_menus" => (array)[
                    (object)[
                      "id" => 5,
                      "title" => "Menús",
                      "path" => "menus",
                      "sort" => 1,
                      "menu_id" => 3,
                      "children_menus" => (array)[]
                    ], (object)[
                      "id" => 6,
                      "title" => "Roles",
                      "path" => "dashboard",
                      "sort" => 2,
                      "menu_id" => 3,
                      "children_menus" => (array)[]
                    ], (object)[
                      "id" => 7,
                      "title" => "Users",
                      "path" => "users.index",
                      "sort" => 3,
                      "menu_id" => 3,
                      "children_menus" => (array)[]
                    ]
                ]
            ]
        ];
    }
    
    private function _resultArrayProvided(): Array
    {
        return [            
            (object)[
                "id" => 1,
                "title" => "Dashboard",
                "path" => "dashboard",
                "sort" => 1,
                "menu_id" => null,
                "alias" => "Dashboard"
            ], (object)[
                "id" => 2,
                "title" => "Registers",
                "path" => "#",
                "sort" => 2,
                "menu_id" => null,
                "alias" => "Registers"
            ], (object)[
                "id" => 4,
                "title" => "Posts",
                "path" => "posts.index",
                "sort" => 1,
                "menu_id" => 2,
                "alias" => "Registers / Posts"
            ], (object)[
                "id" => 3,
                "title" => "Admin.",
                "path" => "#",
                "sort" => 3,
                "menu_id" => null,
                "alias" => "Admin."
            ], (object)[
                "id" => 5,
                "title" => "Menús",
                "path" => "menus",
                "sort" => 1,
                "menu_id" => 3,
                "alias" => "Admin. / Menús"
            ], (object)[
                "id" => 6,
                "title" => "Roles",
                "path" => "dashboard",
                "sort" => 2,
                "menu_id" => 3,
                "alias" => "Admin. / Roles"
            ], (object)[
                "id" => 7,
                "title" => "Users",
                "path" => "users.index",
                "sort" => 3,
                "menu_id" => 3,
                "alias" => "Admin. / Users"
            ]
        ];
    }    
    
}
