<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
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
        if (Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
        // if ($request->getMethod() == "OPTIONS") {
        //   return response(['OK'], 200)
        //     ->withHeaders([
        //       'Access-Control-Allow-Origin' => '*',
        //       'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE',
        //       'Access-Control-Allow-Credentials' => true,
        //       'Access-Control-Allow-Headers' => 'Authorization, Content-Type',
        //     ]);
        // }

        // return $next($request)
        // ->header('Access-Control-Allow-Origin', '*')
        // ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE')
        // ->header('Access-Control-Allow-Credentials', true)
        // ->header('Access-Control-Allow-Headers', 'Authorization, Content-Type');
        // }
}
