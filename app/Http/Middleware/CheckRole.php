<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class CheckRole
{
    /**
     * Handle the incoming request. For use : ->middleware('role:editor');
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (! Auth::user()->hasRole($role)) {
            Session::flash('flash_message', Lang::get('auth.insufficient_rights'));
            Session::flash('flash_type', 'warning');
            return redirect()->route('admin');
        }

        return $next($request);
    }

}
