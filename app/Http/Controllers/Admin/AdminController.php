<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ApproveStatus;
use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Mail\InstructorRequestApprovedMail;
use App\Mail\InstructorRequestRejectedMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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

        $mail = ApproveStatus::from($data['status']) === ApproveStatus::APPROVED ? new InstructorRequestApprovedMail($user) : new InstructorRequestRejectedMail($user);
        $mailPending = Mail::to($user);
        config('lms-mail.on-queue') ? $mailPending->queue($mail) : $mailPending->send($mail);

        return response()->json(['success' => true]);
    }

    public function downloadDocument(User $user)
    {
        if (!Storage::exists($user->document)) {
            return response("{$user->document} not found", status: 404);
        }

        return Storage::download($user->document);
    }
}
