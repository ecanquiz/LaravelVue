<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Repositories\Menu\RecursiveMenuRepository;

class MenuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && !Session::has('menus')) {
            $user = $request->user();
            $role = \App\Models\Role::select('menu_ids')->find($user->role_id);            
            Session::put('menus', RecursiveMenuRepository::recursive($role->menu_ids));
        }
        return $next($request);
    }
}
