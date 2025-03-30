<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\Gender;
use App\Http\Controllers\Controller;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProfileController extends Controller
{
    use FileUpload;

    public function index()
    {
        return view('student/profile/index');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'email' => 'sometimes|email|unique:users,email,' . $request->user()->id,
            'gender' => ['sometimes', Rule::enum(Gender::class)],
            'headline' => '',
            'facebook' => '',
            'bio' => '',
            'name' => '',
            'image' => ['sometimes', 'image']
        ]);

        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $path = $this->upload($data['image'], disk: 'public');
            $data['image'] = $path;
        }

        $request->user()->update($data);

        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed']
        ]);

        $request->user()->update(['password' => bcrypt($data['password'])]);

        return redirect()->back();
    }
}
