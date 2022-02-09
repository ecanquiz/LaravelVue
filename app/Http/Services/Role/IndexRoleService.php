<?php

namespace App\Http\Services\Role;

use Illuminate\Http\Request;
use App\GeneralSettings;
use Inertia\Inertia;
use \App\Models\Role;

class IndexRoleService
{

  /**
   * Display a listing of the resource.
   *
   * @return \Inertia\Response
   */
  static public function execute(Request $request, GeneralSettings $settings): \Inertia\Response
  {
      /* Initialize query */
        $query = Role::query();

        /* search */
        $search = $request->input("search");
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where("name", "like", "%$search%");
            });
        }

        /* sort */
        $sort = $request->input("sort");
        $direction = $request->input("direction") == "desc" ? "desc" : "asc";
        if ($sort) {
            $query->orderBy($sort, $direction);
        }

        /* get paginated results */
        $rolls = $query
            ->paginate($settings->default_pagination)
            ->appends(request()->query());

        return Inertia::render("Roles/Index", [
            "rows" => $rolls,
            "sort" => $request->query("sort"),
            "direction" => $request->query("direction"),
            "search" => $request->query("search"),
        ]);
  }  

}
