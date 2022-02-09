<?php
namespace App\Repositories\Menu;

class RecursiveMenuRepository
{
   /**
   * Return an array of recursive.
   *
   * @return Array
   */    
    static public function recursive(Array $menuIds = []): Array
    {
        return json_decode(
            \App\Models\Menu::whereNull("menu_id")
                ->with(
                    "childrenMenus",                    
                    fn ($query) => $menuIds 
                        ? $query->whereIn("id", $menuIds)
                        : $query
                )->get()
        );
    }    
}
