<?php
namespace App\Repositories\Menu;

class ListMenuRepository
{

   /**
   * Return a recursive array ordered in list.
   * 
   * @param Array $array recursive
   * @return Array
   */
    static public function list(Array $array): Array
    {              
        return self::_process($array);
    }
    
    static private function _process(Array $oldMenus, Array $newMenus = [], String $alias = ''): Array
    {              
         foreach ($oldMenus as $key => $value) {             
             $value->alias = $alias === '' ? $value->title : $alias . ' / ' . $value->title;
             $children_menus = $value->children_menus;
             unset($value->children_menus);
             array_push($newMenus, $value);                        
             if ($children_menus)
                $newMenus = self::_process($children_menus, $newMenus, $value->alias);
         }         
         return $newMenus;     
    }

}
