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

    public function index(string $role)
    {

        return view("frontend/$role/profile/index");
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'gender' => ['sometimes', Rule::enum(Gender::class)],
            'headline' => '',
            'facebook' => '',
            'bio' => '',
            'name' => '',
            'image' => ['sometimes', 'image']
        ]);

        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $this->delete($user->image);
            $path = $this->upload($data['image'], disk: 'public');
            $data['image'] = $path;
        }

        $user->update($data);
        flash()->option('position', 'bottom-right')->success('Profile update successfully!');

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
