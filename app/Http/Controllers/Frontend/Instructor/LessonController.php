<?php

namespace App\Http\Controllers\Frontend\Instructor;

use App\Enums\FileType;
use App\Enums\LessonType;
use App\Enums\VideoStorageType;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Course\Chapter;
use App\Models\Course\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
            'video_url' => ['required', 'string'],
            'order' => 'required',
            'duration' => 'required'
        ]);

        $data['is_downloadable'] = $request->boolean('is_downloadable');
        $data['is_preview'] = $request->boolean('is_preview');
        $data['user_id'] = $request->user()->id;
        $data['chapter_id'] = $chapter->id;
        $data['course_id'] = $chapter->course_id;

        $videoUrl = parse_url($data['video_url']);
        $data['video_url'] = sprintf('%s?%s', $videoUrl['path'] ?? '', $videoUrl['query'] ?? '');

        Lesson::create($data);

        return response()->json(['message' => 'Lesson created successfully']);
    }

    public function update(Request $request, Chapter $chapter, Lesson $lesson)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'storage' => [Rule::enum(VideoStorageType::class)],
            'file_type' => Rule::enum(FileType::class),
            'lesson_type' => Rule::enum(LessonType::class),
            'video_url' => ['nullable', 'string'],
            'order' => 'required',
            'duration' => 'required'
        ]);

        $data['is_downloadable'] = $request->boolean('is_downloadable');
        $data['is_preview'] = $request->boolean('is_preview');

        if (!empty($data['video_url'])) {
            $videoUrl = parse_url($data['video_url']);
            $data['video_url'] = sprintf('%s?%s', $videoUrl['path'] ?? '', $videoUrl['query'] ?? '');
        }

        $lesson->update($data);

        return response()->json(['message' => 'Lesson updated successfully']);
    }

    public function destroy(Chapter $chapter, Lesson $lesson)
    {
        $lesson->delete();

        flash()->option('position', 'bottom-right')->success('Delete lesson successfully!');

        return redirect()->route('instructor.courses.edit', [$chapter->course_id, Course::COURSE_CONTENT]);
    }
}
