<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    function __invoke(Request $request)
    {
        $s = $request->input("s");
        $r = $this->searchUsers($s);
        return array_merge($r);
    }
    public function searchUsers($s)
    {
        return User::select("id", "name")
            ->where("name", "like", "%$s%")
            ->orderBy("name", "asc")
            ->take(5)
            ->get()
            ->map(
                fn($i) => [
                    "text" => $i->name,
                    "url" => route("users.show", ["user" => $i->id]),
                ]
            )
            ->all();
    }
}
