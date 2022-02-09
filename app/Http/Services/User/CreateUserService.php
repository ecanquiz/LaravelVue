<?php
namespace App\Http\Services\User;

use Inertia\{
    Inertia,
    Response
};
use App\Models\Role;

class CreateUserService
{

  static public function execute(): Response
  {
      return Inertia::render( "Users/Create", [
          "roles" => Role::select('id', 'name')
                           ->orderBy('name')
                           ->get()
                           ->toArray()
      ]);
  }

}


