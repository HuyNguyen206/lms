<?php

namespace App\Http\Controllers\Frontend\Instructor;

use App\Enums\FileType;
use App\Enums\LessonType;
use App\Enums\VideoStorageType;
use App\Http\Controllers\Controller;
use App\Models\Course\Chapter;
use App\Models\Course\Lesson;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LessonController extends Controller
{
    public function store(Request $request, Chapter $chapter)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'storage' => [Rule::enum(VideoStorageType::class)],
            'file_type' => Rule::enum(FileType::class),
            'lesson_type' => Rule::enum(LessonType::class),
            'source_path' => 'string',
            'filepath' => 'string',
            'order' => 'required',
            'duration' => 'required'
        ]);

        $data['is_downloadable'] = $request->boolean('is_downloadable');
        $data['is_preview'] = $request->boolean('is_preview');
        $data['user_id'] = $request->user()->id;
        $data['chapter_id'] = $chapter->id;
        $data['course_id'] = $chapter->course_id;

        if (isset($data['filepath'])) {
            unset($data['filepath']);
        }

        if (isset($data['source_path'])) {
            unset($data['source_path']);
        }

        Lesson::create($data);

        return response()->json(['message' => 'Lesson created successfully']);
    }
}
