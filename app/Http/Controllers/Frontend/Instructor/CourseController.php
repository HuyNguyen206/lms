<?php

namespace App\Http\Controllers\Frontend\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    use FileUpload;
    public function create(string $stage)
    {
        return view('frontend/instructor/course/create', compact('stage'));
    }

    public function index()
    {
        return view('frontend/instructor/course/index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:courses,name',
            'seo_description' => '',
            'thumbnail' => 'required|image',
            'demo_video_storage' => ['mimetypes:video/avi,video/mpeg,video/quicktime'],
            'price' => ['numeric'],
            'discount_price' => ['numeric'],
            'description' => ['string'],
        ]);

        $thumbnailPath = $this->upload($data['thumbnail'], disk: 'public', folder: 'course');
        $data['thumbnail'] = $thumbnailPath;

        if ($video = $request->file('demo_video_storage')) {
            $videoPath = $this->upload($video, disk: 'public', folder: 'course/video');
            $data['demo_video_storage'] = $videoPath;
        }

        $data['user_id'] = $request->user()->id;
        $course = Course::create($data);

        flash()->option('position', 'bottom-right')->success('Course store successfully!');

        session('course_create_id', $course->id);

        return redirect()->route('instructor.courses.create', Course::MORE_INFO);
    }
}
