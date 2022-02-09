<?php

namespace App\Http\Services\Menu;

use \Illuminate\Database\Eloquent\Collection;
use \App\Http\Requests\Menu\ChildrenMenuRequest;
use \App\Models\Menu;

class ChildreMenuService
{

  static public function execute(ChildrenMenuRequest $request): Collection
  {
      return $request->menuId ?
          Menu::where('menu_id', $request->menuId)->get() :
          Menu::whereNull('menu_id')->get();                
  }

}
