<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CheckRolePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $role = Role::find(auth()->user()->role_id);
        $current_route = Route::current()->getName();
        $access = false;
        foreach ($role->permissions as $permission){
            if ($current_route == $permission->route){
                return $next($request);
            }
        }
        if ($access == false){
            request()->session()->flash('invalid_access', 'Access Denied');
            return redirect()->route('home');
        }

        return $next($request);
    }
}
