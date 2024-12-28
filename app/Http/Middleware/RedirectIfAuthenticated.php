<?php

namespace App\Http\Middleware;

use App\Util\Helper;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated as BaseRedirectIfAuthenticated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated extends BaseRedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (Response)  $next
     */
    public function handle(Request $request, \Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard ?? Helper::getGuard($request))->check()) {
                return redirect($this->redirectTo($request));
            }
        }

        return $next($request);
    }

    protected function defaultRedirectUri(): string
    {
       $dashboardUrl = Helper::getGuard(\request()) === 'admin' ? ['admin.dashboard'] : ['dashboard'];
        foreach ($dashboardUrl as $uri) {
            if (Route::has($uri)) {
                return route($uri);
            }
        }

        $routes = Route::getRoutes()->get('GET');

        foreach ($dashboardUrl as $uri) {
            if (isset($routes[$uri])) {
                return '/'.$uri;
            }
        }

        return '/';
    }
}
