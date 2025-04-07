<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Models\Course\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use PHPUnit\Framework\Exception;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();

        return view('admin.course.language.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.course.language.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(['name' => ['required', 'unique:languages,name']]);

        Language::create($data);

        flash()->option('position', 'bottom-right')->success('Language store successfully!');

        return redirect()->route('admin.courses.languages.index');
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
    public function edit(Language $language)
    {
        return view('admin.course.language.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Language $language)
    {
        $data = $request->validate(['name' => ['required', Rule::unique('languages', 'name')->ignoreModel($language)]]);

        $language->update($data);

        flash()->option('position', 'bottom-right')->success('Language update successfully!');

        return redirect()->route('admin.courses.languages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language)
    {
        $language->delete();
        flash()->option('position', 'bottom-right')->success('Language delete successfully!');

        return redirect()->route('admin.courses.languages.index');
    }
}
