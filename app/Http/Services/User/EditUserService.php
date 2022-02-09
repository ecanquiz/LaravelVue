<?php
namespace App\Http\Services\User;

use Inertia\Inertia;
use App\Models\{
    Role,
    User    
};

class EditUserService
{

  static public function execute(User $user): \Inertia\Response
  {
        return Inertia::render("Users/Edit", [
            "user" => $user->only(["id", "name", "email", "role_id"]),
            "roles" => Role::select('id', 'name')
                           ->orderBy('name')
                           ->get()
                           ->toArray()
        ]);
  }

}
