<?php
namespace App\Http\Services\Role;

use App\Models\Role;
use App\Repositories\Menu\{
    ListMenuRepository,
    RecursiveMenuRepository
};
use Inertia\{
    Inertia,
    Response
};

class ShowRoleService
{

  static public function execute(Role $role): Response
  {
       $menus = ListMenuRepository::list(
              RecursiveMenuRepository::recursive()
       );

       return Inertia::render("Roles/Show", [
	       "role"  => (object)$role->toArray(), 
           "menus" => $menus,
       ]);
  }

}
