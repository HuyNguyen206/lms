<?php

if (!function_exists('route_user')) {
    function route_user(string $routeName, \App\Models\User $user = null, bool $absolute = true)
    {
        $user ??= auth(\App\Util\Helper::getGuard(request()))->user();

        if ($user === null) {
            throw new Exception('User must be authenticated or provided');
        }

        return route($user->getRoleName() . ".$routeName", absolute: $absolute);
    }
}
