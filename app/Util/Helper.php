<?php

namespace App\Util;

use Illuminate\Http\Request;

class Helper
{
    public static function getGuard(Request $request)
    {
        return $request->routeIs('admin.*') ? 'admin' : 'web';
    }
}
