<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\View\View;

class AuthenticatedSessionController extends \App\Http\Controllers\Auth\AuthenticatedSessionController
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('admin.auth.login');
    }

    protected function redirectPostLogin()
    {
        return redirect()->intended(route('admin.dashboard', absolute: false));
    }
}
