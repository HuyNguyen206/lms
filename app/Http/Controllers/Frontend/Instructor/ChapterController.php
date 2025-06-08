<?php

namespace App\Http\Controllers\Frontend\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $data = $request->validate(['title' => 'required', 'order' => ['required', 'integer']]);

        $data['user_id'] = $request->user()->id;
        $data['course_id'] = $course->id;

        Course\Chapter::create($data);

        return response()->json(['message' => 'Chapter created successfully']);
    }

    public function update(Request $request, Course $course, Course\Chapter $chapter)
    {

    }
}
