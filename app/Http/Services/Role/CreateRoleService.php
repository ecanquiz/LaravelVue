<?php
namespace App\Http\Services\Role;

use Inertia\Inertia;
use App\Repositories\Menu\{
    ListMenuRepository,
    RecursiveMenuRepository
};

class CreateRoleService
{

  static public function execute(): \Inertia\Response
  { 
       $menus = ListMenuRepository::list(
              RecursiveMenuRepository::recursive()
       );

       return \Inertia\Inertia::render("Roles/Create", [
           "menus" => $menus,
       ]);
  }

}
