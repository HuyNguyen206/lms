<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ApproveStatus;
use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function instructorRequests()
    {
        $instructors =  User::query()->where('role', Role::INSTRUCTOR)
            ->whereIn('approve_instructor_status', [ApproveStatus::PENDING, ApproveStatus::REJECTED])->paginate();

        return view('admin.instructor.index', compact('instructors'));
    }

    public function updateStatus(Request $request, User $user)
    {
        $data = $request->validate([
            'status' => Rule::enum(ApproveStatus::class)
        ]);

        $user->update([
            'approve_instructor_status' => $data['status'],
        ]);

        return response()->json(['success' => true]);
    }
}
