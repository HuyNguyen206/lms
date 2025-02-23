<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function instructorRequests()
    {
        $instructors =  User::query()->where('role', Role::INSTRUCTOR)->paginate();

        return view('admin.instructor.index', compact('instructors'));
    }
}
