<?php
namespace App\Http\Services\Role;

use Illuminate\Support\Facades\Redirect;
//use App\Http\Validator\Role\StoreRoleValidator;
//use App\Http\Requests\Role\StoreRoleRequest;
use Illuminate\Http\Request;
use App\Models\Role;

class StoreRoleService
{

  //static public function execute(StoreRoleRequest $request): \Illuminate\Http\RedirectResponse
  static public function execute(Request $request): \Illuminate\Http\RedirectResponse
  { 

      $msg  = 'Invalid data.';

      //if ( !StoreRoleValidator::rule( $request )->fails() ) {

          Role::create([              
              "name" => $request->name,
              "menu_ids" => $request->menu_ids,
              "description" => $request->description         
          ]);         

          $msg  = 'Role stored.';

      //}

      return Redirect::route('roles')->with('success', $msg);

  }

}
