<?php
namespace App\Http\Controllers;

use App\GeneralSettings;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post;


class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index(Request $request, GeneralSettings $settings)
    {
        
        /* Initialize query */
        $query = Post::query();

        /* search */
        $search = $request->input("search");
        if ($search) {
            $query
                ->where("title", "like", "%$search%")
                ->orWhere("body", "like", "%$search%");
        }

        /* sort */
        $sort = $request->input("sort");
        $direction = $request->input("direction") == "desc" ? "desc" : "asc";
        if ($sort) {
            $query->orderBy($sort, $direction);
        }

        /* get paginated results */
        $posts = $query
            ->paginate($settings->default_pagination)
            ->appends(request()->query());

        return Inertia::render("Posts/Index", [
            "rows" => $posts,
            "sort" => $request->query("sort"),
            "direction" => $request->query("direction"),
            "search" => $request->query("search"),
        ]);
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            "title" => ["required"],
            "body" => ["required"],
        ])->validate();

        Post::create($request->all());

        return redirect()
            ->back()
            ->with("success", "Publicación creada.");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            "title" => ["required"],
            "body" => ["required"],
        ])->validate();

        if ($request->has("id")) {
            Post::find($request->input("id"))->update($request->all());
            return redirect()
                ->back()
                ->with("success", "Publicación Actualizada.");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function destroy(Request $request)
    {
        if ($request->has("id")) {
            Post::find($request->input("id"))->delete();
            return redirect()->back();
        }
    }
}
