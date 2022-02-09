<?php
namespace App\Http\Services\Role;

use Inertia\Inertia;
use App\Models\Role;
use App\Repositories\Menu\{
    ListMenuRepository,
    RecursiveMenuRepository
};

class EditRoleService
{

  static public function execute(Role $role): \Inertia\Response
  {
       $menus = ListMenuRepository::list(
              RecursiveMenuRepository::recursive()
       );

       return \Inertia\Inertia::render("Roles/Edit", [
	   "role"  => (object)$role->toArray(), 
           "menus" => $menus,
       ]);
  }

}
