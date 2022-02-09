<?php
namespace App\Http\Services\Menu;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Menu\DestroyMenuRequest;
use App\Models\Menu;

class DestroyMenuService
{
 
  static public function execute(DestroyMenuRequest $request): \Illuminate\Http\RedirectResponse
  { 

      $msg  = 'Invalid argument.';
      $menu = Menu::findOrFail($request->id);
      $menu->delete();
      $msg  = 'Menu remove.';
            
      return Redirect::route('menus')->with('success', $msg);

  }
    
}
