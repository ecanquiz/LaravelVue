<?php
namespace App\Http\Services\User;

use App\Models\User;
use Inertia\{
    Inertia,
    Response
};

class ShowUserService
{

  static public function execute(User $user): Response
  {  
       $user->role = $user["role"]["name"];
       $user = (object)$user->only(["name", "email", "role"]);
             
       return Inertia::render("Users/Show", compact("user"));
  }

}
