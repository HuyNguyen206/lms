<?php

if (!function_exists('route_user')) {
    function route_user(string $routeName, \App\Models\User $user = null, bool $absolute = true, string $role = null)
    {
//        $user ??= auth(\App\Util\Helper::getGuard(request()))->user();
//
//        if ($user === null) {
//            throw new Exception('User must be authenticated or provided');
//        }
        if ($role) {
            return route($role . ".$routeName", absolute: $absolute);
        }

        if ($user) {
            return route($user->getRoleName() . ".$routeName", absolute: $absolute);
        }

        return route($routeName, absolute: $absolute);
    }
}
