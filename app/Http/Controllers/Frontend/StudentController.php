<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    use FileUpload;

    public function index(): View
    {
        return \view('student.dashboard');
    }

    public function instructorRegistration()
    {
        return \view('student.instructor-request');
    }

    public function instructorRegistrationPatch(Request $request)
    {
        $request->validate(['document' => ['required', 'mimes:pdf,doc,docx,jpg,png', 'max:30000']]);

        $user = $request->user();
        $filePath = $this->upload($request->file('document'), $user->id);

        $user->update([
            'document' => $filePath,
            'role' => Role::INSTRUCTOR,
            'approve_instructor_status' => \App\Enums\ApproveStatus::PENDING,
        ]);

        return response()->redirectTo(route('instructor.dashboard'));
    }
}
