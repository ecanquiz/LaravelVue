<?php

namespace App\Http\Services\User;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\{
    GeneralSettings,
    Models\User,
    Models\Role
} ;

class IndexUserService
{

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    static public function execute(Request $request, GeneralSettings $settings): \Inertia\Response    
    {
        /* Initialize query */
        $query = User::query()->with("role");

        /* search */
        $search = $request->input("search");
        if ($search) {
            $query->where(function ($query) use ($search) {
                $query
                    ->where("name", "like", "%$search%")
                    ->orWhere("email", "like", "%$search%")
                    ->orWhereHas("role", function ($q) use ($search) {
                        $q->where("name", "like", "%$search%");
                    });
            });
        }

        /* sort */
        $sort = $request->input("sort");
        $direction = $request->input("direction") == "desc" ? "desc" : "asc";
        
        /*if ($sort) { $query->orderBy($sort, $direction); }*/        
        if ($sort === "role") {
            $query->orderBy(
                Role::select("name")
                    ->whereColumn("role_id", "roles.id")
                    ->orderBy("role_id")
                    ->limit(1),
                $direction
            );
        } elseif ($sort) {
            $query->orderBy($sort, $direction);
        }

        /* get paginated results */
        $users = $query
            ->paginate($settings->default_pagination)
            ->appends(request()->query());

        return Inertia::render("Users/Index", [
            "rows" => $users,
            "sort" => $request->query("sort"),
            "direction" => $request->query("direction"),
            "search" => $request->query("search"),
        ]);
    }

}
