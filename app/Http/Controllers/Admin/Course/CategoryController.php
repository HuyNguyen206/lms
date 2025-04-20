<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    use FileUpload;
    public function index()
    {
        return view('admin/course/category/index', ['categories' => Category::with('parentCategory')->paginate()]);
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin/course/category/create', compact('categories'));
    }

    public function edit(Category $category)
    {
        $categories = Category::where('id', '<>', $category->id)->get();

        return view('admin/course/category/edit', compact('category', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'unique:categories'],
            'icon' => ['image'],
            'parent_id' => ['nullable', Rule::exists(Category::class, 'id')],
        ]);

        $data['is_show_at_trending'] = $request->boolean('is_show_at_trending');
        $data['is_enable'] = $request->boolean('is_enable');

        if ($request->file('icon')) {
            $path = $this->upload($data['icon'], disk: 'public', folder: 'logo');
            $data['icon'] = $path;
        }

        if ($request->file('image')) {
            $path = $this->upload($data['image'], disk: 'public', folder: 'logo');
            $data['image'] = $path;
        }

        Category::create($data);
        flash()->option('position', 'bottom-right')->success('Category store successfully!');

        return redirect()->to(route('admin.courses.categories.index'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'string', Rule::unique(Category::class)->ignoreModel($category)],
            'icon' => ['image'],
            'image' => ['image'],
            'parent_id' => ['nullable', Rule::exists(Category::class, 'id')]
        ]);
        $data['is_show_at_trending'] = $request->boolean('is_show_at_trending');
        $data['is_enable'] = $request->boolean('is_enable');

        if ($request->file('icon')) {
            $path = $this->upload($data['icon'], disk: 'public', folder: 'logo');
            $data['icon'] = $path;
            $this->delete($category->icon, disk: 'public');
        }

        if ($request->file('image')) {
            $path = $this->upload($data['image'], disk: 'public', folder: 'logo');
            $data['image'] = $path;
            $this->delete($category->image, disk: 'public');
        }

        $category->update($data);
        flash()->option('position', 'bottom-right')->success('Category update successfully!');

        return redirect()->to(route('admin.courses.categories.index'));
    }

    public function destroy(Category $category)
    {
        $category->delete();

        flash()->option('position', 'bottom-right')->success('Category delete successfully!');

        return redirect()->to(route('admin.courses.categories.index'));
    }
}
