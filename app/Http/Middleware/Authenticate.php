<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                Session::flash('flash_message', Lang::get('auth.not_logged'));
                Session::flash('flash_type', 'warning');
                return redirect()->route('login');
            }
        }

        if ( ! Auth::user()->enabled) {
            Session::flash('flash_message', Lang::get('auth.disabled'));
            Session::flash('flash_type', 'warning');
            Auth::logout();
            return redirect()->route('login');
        }

        return $next($request);
    }
}
