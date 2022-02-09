<?php
namespace App\Http\Services\Role;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Role;

class DestroyRoleService
{

  static public function execute(Request $request): \Illuminate\Http\RedirectResponse
  { 

      $msg  = 'Invalid argument.';
      $role = Role::findOrFail($request->id);
      $role->delete();
      $msg  = 'Role remove.';

      return Redirect::route('roles')->with('success', $msg);

  }

}
