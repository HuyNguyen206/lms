<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course\Lesson;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InstructorController extends Controller
{
    public const CHAPTER_CREATE = 'chapter-create';
    public const LESSON_CREATE = 'lesson-create';
    public const LESSON_EDIT = 'lesson-edit';
    public function index(): View
    {
        return \view('frontend.instructor.dashboard');
    }

    public function viewModal(string $type, Request $request)
    {
        switch ($type)  {
            case self::CHAPTER_CREATE:
                return \view('frontend.instructor.partial.modal-view.course.chapter-create', ['routeSubmit' => request()->{'route-submit'}])->render();
            case self::LESSON_CREATE:
                return \view('frontend.instructor.partial.modal-view.course.lesson-create', ['routeSubmit' => request()->{'route-submit'}])->render();
            case self::LESSON_EDIT:
                return \view('frontend.instructor.partial.modal-view.course.lesson-edit', [
                        'routeSubmit' => request()->{'route-submit'},
                        'chapter' => $request->chapter,
                        'lesson' => Lesson::findOrFail($request->lesson)
                    ])
                    ->render();
            default:
                return \view('frontend.instructor.partial.modal-view.course.create');
        }
    }
}
