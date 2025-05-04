<?php

namespace App\Http\Controllers\Frontend\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    use FileUpload;

    public function create(string $stage)
    {
//        Session::forget(['course_create_id', 'stage_transition']);
//        return ;
        $categories = Category::all();
        $languages = Course\Language::all();
        $levels = Course\Level::all();

        if (!session('course_create_id')) {
            if ($stage === Course::BASIC_INFO) {
                return view('frontend/instructor/course/create', compact('stage', 'categories', 'languages', 'levels'));
            }

            flash()->option('position', 'bottom-right')->warning("Redirect from stage $stage to stage basic-info");

            return response()->redirectTo(route('instructor.courses.create', Course::BASIC_INFO));
        }


        if ($stage !== ($correctStage = current(session('stage_transition')))) {
            flash()->option('position', 'bottom-right')->warning("Redirect from stage $stage to stage $correctStage");

            return response()->redirectTo(route('instructor.courses.create', $correctStage));
        }

        return view('frontend/instructor/course/create', ['stage' => $correctStage] + compact('categories', 'languages', 'levels'));
    }

    public function index()
    {
        return view('frontend/instructor/course/index');
    }

    public function store(Request $request, string $stage)
    {
        switch ($stage) {
            case Course::BASIC_INFO:
                return $this->stage1($request);
            case Course::MORE_INFO:
                return $this->stage2($request);
            case Course::COURSE_CONTENT:
            case Course::FINISH:
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    private function stage1(Request $request): \Illuminate\Http\RedirectResponse
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
        flash()->option('position', 'bottom-right')->success('Course basic info store successfully!');

        Session::put('course_create_id', $course->id);
        Session::put('stage_transition', Course::STAGE_TRANSITION_1);

        return redirect()->route('instructor.courses.create', Course::MORE_INFO);
    }

    private function stage2(Request $request)
    {
        if (!session('course_create_id') || session('next_stage') !== Course::MORE_INFO) {
            return redirect()->route('instructor.courses.create', Course::BASIC_INFO);
        }

        $data = $request->validate([
            'capacity' => 'required',
            'level_id' => ['required', Rule::exists('levels', 'id')],
            'duration' => 'required',
            'category_id' => [Rule::exists('categories', 'id')],
            'language_id' => [Rule::exists('languages', 'id')],
        ]);

        $isQNA = $request->boolean('qna');
        $hasCertificate = $request->boolean('has_certificate');
        $data = [...$data, ...compact('isQNA', 'hasCertificate')];

        Course::whereKey(session('course_create_id'))->update($data);

        flash()->option('position', 'bottom-right')->success('Course more info store successfully!');

        Session::put('stage_transition', Course::STAGE_TRANSITION_2);

        return redirect()->route('instructor.courses.create', Course::COURSE_CONTENT);
    }
}
