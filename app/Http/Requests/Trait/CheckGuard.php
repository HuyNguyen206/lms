<?php

namespace App\Http\Requests\Trait;

trait CheckGuard
{
    public function getGuard(): string
    {
        return \request()->routeIs('admin.login') ? 'admin' : 'web';
    }
}
