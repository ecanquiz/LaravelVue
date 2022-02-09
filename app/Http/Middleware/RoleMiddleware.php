<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $roles)
    {
        $user = $request->user();

        // if not logged in
        if (!$user) {
            return redirect()->route('login');
        }

        // check roles
        $roles = explode("|", $roles);
        
        foreach ($roles as $role) {
            if ($user->role->name == $role) {
                return $next($request);
            }
        }

        // deny
        abort(403, "No tienes permisos suficientes para acceder (rol {$user->role->name})");
    }
}
