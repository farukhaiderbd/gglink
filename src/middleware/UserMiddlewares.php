<?php

namespace Codershout\GGLink\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserMiddlewares
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      dd(Session::get('authenticated'));
        if (!empty(session('authenticated'))) {
            $request->session()->put('authenticated', true);
            return $next($request);
        }

        return redirect('/login');

    }
}
