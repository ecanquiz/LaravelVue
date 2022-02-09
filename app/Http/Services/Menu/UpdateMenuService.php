<?php
namespace App\Http\Services\Menu;

use Illuminate\Support\Facades\Redirect;
use App\Http\Validator\Menu\UpdateMenuValidator;
use App\Http\Requests\Menu\UpdateMenuRequest;
use App\Models\Menu;

class UpdateMenuService
{
 
  static public function execute(UpdateMenuRequest $request, Menu $menu): \Illuminate\Http\RedirectResponse
  { 

      $msg  = 'Invalid data.';
      //$code = 202;

      if ( !UpdateMenuValidator::rule( $request )->fails() ) {      
          $menu->update( $request->except( '_method', 'id' ) );
          $msg  = 'Menu updated.';
          //$code = 200;          
      }  

      //return response()->json( compact( 'msg' ), $code );
      return Redirect::route('menus')->with('success', $msg);

  }
    
}
