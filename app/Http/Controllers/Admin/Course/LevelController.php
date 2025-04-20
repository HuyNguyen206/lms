<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Models\Course\Language;
use App\Models\Course\Level;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $levels = Level::query()->paginate();

        return view('admin.course.level.index', compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.course.level.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(['name' => ['required', 'unique:levels,name']]);

        Level::create($data);

        flash()->option('position', 'bottom-right')->success('Level store successfully!');

        return redirect()->route('admin.courses.levels.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Level $level)
    {
        return view('admin.course.level.edit', compact('level'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Level $level)
    {
        $data = $request->validate(['name' => ['required', Rule::unique('levels', 'name')->ignoreModel($level)]]);

        $level->update($data);

        flash()->option('position', 'bottom-right')->success('Level update successfully!');

        return redirect()->route('admin.courses.levels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Level $level)
    {
        $level->delete();
        flash()->option('position', 'bottom-right')->success('Level delete successfully!');

        return redirect()->route('admin.courses.levels.index');
    }
}
