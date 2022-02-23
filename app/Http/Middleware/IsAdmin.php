<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Support\Facades\Config;

class IsAdmin
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
        $adminRole = Role::where('name', '=', Config::get('constants.db.roles.admin'))->first();
        if ($request->user()->role_id!==$adminRole->id) {
            return abort(404,'You Not Admin!');
        }

        return $next($request);
    }
}














