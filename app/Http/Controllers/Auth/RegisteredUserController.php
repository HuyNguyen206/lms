<?php

namespace App\Http\Controllers\Auth;

use App\Enums\ApproveStatus;
use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $baseRule = [
            'type' => ['required', Rule::enum(Role::class)],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];

        $isInstructor = (int) $request->type === Role::INSTRUCTOR->value;
        if ($isInstructor) {
            $baseRule['document'] = ['required'];
        }

        $request->validate($baseRule);

        /**
         * @var User $user
         */
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->type,
            'approve_instructor_status' => $isInstructor ? ApproveStatus::PENDING->value : null
        ]);

        event(new Registered($user));

        Auth::login($user);
        return redirect(route('student.dashboard', absolute: false));
    }
}
