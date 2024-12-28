<?php

namespace App\Http\Middleware;

use App\Util\Helper;
use Closure;
use Illuminate\Http\Request;

class Authenticate extends \Illuminate\Auth\Middleware\Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        self::redirectUsing(function (Request $request) {
            return Helper::getGuard($request) === 'admin' ? route('admin.login') : route('login');
        });

        return parent::handle($request, $next, ...$guards);
    }
}
