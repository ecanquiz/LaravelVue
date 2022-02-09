<?php
namespace App\Http\Services\Menu;

use Illuminate\Support\Facades\Redirect;
use App\Http\Validator\Menu\StoreMenuValidator;
use App\Http\Requests\Menu\StoreMenuRequest;
use App\Models\Menu;

class StoreMenuService
{
 
  static public function execute(StoreMenuRequest $request): \Illuminate\Http\RedirectResponse
  { 

      $msg  = 'Invalid data.';      
      
      if ( !StoreMenuValidator::rule( $request )->fails() ) {

          Menu::create([
              "title" => $request->title,
              "menu_id" => $request->menu_id===0 ? null : $request->menu_id,
              "path" => $request->path,
              "icon" => $request->icon,
              "sort" => $request->sort
          ]);         

          $msg  = 'Menu stored.';
         
      }
      
      return Redirect::route('menus')->with('success', $msg);

  }
    
}
