<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class InstructorController extends Controller
{
    public const COURSE_CREATE = 'course-create';
    public function index(): View
    {
        return \view('frontend.instructor.dashboard');
    }

    public function viewModal(string $type)
    {
        switch ($type)  {
            case self::COURSE_CREATE:
                return \view('frontend.instructor.partial.modal-view.course.create', ['routeSubmit' => request()->{'route-submit'}])->render();
            default:
                return \view('frontend.instructor.partial.modal-view.course.create');
        }
    }
}
