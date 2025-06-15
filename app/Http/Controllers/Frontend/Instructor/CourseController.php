<?php

namespace App\Http\Controllers\Frontend\Instructor;

use App\Enums\VideoStorageType;
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
        $parentCategories = Category::where('is_enable', 1)
            ->whereNull('parent_id')
            ->withWhereHas('categories')
            ->get();
        $languages = Course\Language::all();
        $levels = Course\Level::all();

        if (!session('course_create_id')) {
            if ($stage === Course::BASIC_INFO) {
                return view('frontend/instructor/course/create/create', compact('stage', 'parentCategories', 'languages', 'levels'));
            }

            flash()->option('position', 'bottom-right')->warning("Redirect from stage $stage to stage basic-info");

            return response()->redirectTo(route('instructor.courses.create', Course::BASIC_INFO));
        }


        if ($stage !== ($correctStage = current(session('stage_transition')))) {
            flash()->option('position', 'bottom-right')->warning("Redirect from stage $stage to stage $correctStage");

            return response()->redirectTo(route('instructor.courses.create', $correctStage));
        }

        return view('frontend/instructor/course/create/create', ['stage' => $correctStage] + compact('parentCategories', 'languages', 'levels'));
    }

    public function edit(Course $course, ?string $stage = null)
    {
        $stage = $stage ?? Course::BASIC_INFO;

        $parentCategories = Category::where('is_enable', 1)
            ->whereNull('parent_id')
            ->withWhereHas('categories')
            ->get();
        $languages = Course\Language::all();
        $levels = Course\Level::all();

        $data = compact('course', 'stage', 'parentCategories', 'languages', 'levels');

        if ($stage === Course::COURSE_CONTENT) {
            $courseChapters = $course->chapters;
            $data['chapters'] = $courseChapters;
        }

        return view("frontend/instructor/course/edit/edit", $data);

    }

    public function index()
    {
        $courses = Course::where('user_id', auth()->id())->latest()->paginate();

        return view('frontend/instructor/course/index', compact('courses'));
    }

    public function store(Request $request, string $stage)
    {
        switch ($stage) {
            case Course::BASIC_INFO:
                return $this->createStage1($request);
            case Course::MORE_INFO:
                return $this->createStage2($request);
            case Course::COURSE_CONTENT:
            case Course::FINISH:
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    private function createStage1(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|unique:courses,name',
            'seo_description' => '',
            'thumbnail' => 'required|image',
            'demo_video_storage' => [Rule::enum(VideoStorageType::class)],
            'filepath' => ['string'],
            'price' => ['numeric'],
            'discount_price' => ['numeric'],
            'description' => ['string'],
        ]);

        $thumbnailPath = $this->upload($data['thumbnail'], disk: 'public', folder: 'course');
        $data['thumbnail'] = $thumbnailPath;

        if ($request->has('demo_video_url')) {
            $data['demo_video_url'] = $request->get('filepath');
        }
        unset($data['filepath']);

        $data['user_id'] = $request->user()->id;
        $course = Course::create($data);
        flash()->option('position', 'bottom-right')->success('Course basic info store successfully!');

        Session::put('course_create_id', $course->id);
        Session::put('stage_transition', Course::STAGE_TRANSITION_1);

        return redirect()->route('instructor.courses.create', Course::MORE_INFO);
    }

    private function createStage2(Request $request)
    {
//        if (!session('course_create_id') || session('next_stage') !== Course::MORE_INFO) {
//            return redirect()->route('instructor.courses.create', Course::BASIC_INFO);
//        }

        $data = $request->validate([
            'capacity' => 'required',
            'level_id' => ['required', Rule::exists('levels', 'id')],
            'duration' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'language_id' => ['required', Rule::exists('languages', 'id')],
        ]);

        $qna = $request->boolean('qna');
        $hasCertificate = $request->boolean('has_certificate');
        $data = [...$data, ...['qna' => $qna, 'has_certificate' => $hasCertificate]];

        Course::whereKey(session('course_create_id'))->update($data);

        flash()->option('position', 'bottom-right')->success('Course more info store successfully!');

        Session::put('stage_transition', Course::STAGE_TRANSITION_2);

        return redirect()->route('instructor.courses.create', Course::COURSE_CONTENT);
    }

    public function update(Request $request, Course $course, string $stage)
    {
        switch ($stage) {
            case Course::BASIC_INFO:
                return $this->updateStage1($request, $course);
            case Course::MORE_INFO:
                return $this->updateStage2($request, $course);
            case Course::COURSE_CONTENT:
            case Course::FINISH:
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    private function updateStage1(Request $request, Course $course): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|unique:courses,name',
            'seo_description' => '',
            'demo_video_storage' => ['mimetypes:video/avi,video/mpeg,video/quicktime'],
            'price' => ['numeric'],
            'discount_price' => ['numeric'],
            'description' => ['string'],
        ]);


        if ($request->file('thumbnail')) {
            $thumbnailPath = $this->upload($data['thumbnail'], disk: 'public', folder: 'course');
            $data['thumbnail'] = $thumbnailPath;
            $this->delete($course->thumbnail, disk: 'public');

        }

        if ($video = $request->file('demo_video_storage')) {
            $videoPath = $this->upload($video, disk: 'public', folder: 'course/video');
            $data['demo_video_storage'] = $videoPath;
            $this->delete($course->demo_video_storage, disk: 'public');
        }

        $course->update($data);

        flash()->option('position', 'bottom-right')->success('Course basic info update successfully!');

        return redirect()->route('instructor.courses.edit',[$course, Course::MORE_INFO]);
    }

    private function updateStage2(Request $request, Course $course)
    {
        $data = $request->validate([
            'capacity' => 'required',
            'level_id' => ['required', Rule::exists('levels', 'id')],
            'duration' => 'required',
            'category_id' => [Rule::exists('categories', 'id')],
            'language_id' => [Rule::exists('languages', 'id')],
        ]);

        $qna = $request->boolean('qna');
        $hasCertificate = $request->boolean('has_certificate');
        $data = [...$data, ...['qna' => $qna, 'has_certificate' => $hasCertificate]];

        $course->update($data);

        flash()->option('position', 'bottom-right')->success('Course more info update successfully!');

        return redirect()->route('instructor.courses.edit',[$course, Course::COURSE_CONTENT]);
    }
}
