<?php

namespace App\Http\Services\Menu;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use \App\Repositories\Menu\{
    ListMenuRepository,
    RecursiveMenuRepository
};

class MenuService
{

  /**
   * Display a listing of the resource.
   *
   * @return \Inertia\Response
   */
  static public function execute(): \Inertia\Response
  {
      $menus = self::get(
          ListMenuRepository::list(
              RecursiveMenuRepository::recursive()
          )
      );
      
      return \Inertia\Inertia::render(
        'Menus/Index',
        compact('menus')
      );
  }
  
  static public function get($items, $perPage = 5, $page = null, $options = [])
  {
      $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
      $items = $items instanceof Collection ? $items : Collection::make($items);
      $response = new LengthAwarePaginator(
          $items->forPage($page, $perPage),
          $items->count(),
          $perPage,
          $page,
          $options
      );
      return $response->setPath(url()->current());
  }

}
