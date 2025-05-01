<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $subCategories = Category::whereNull('parent_id')->get();

        return view('admin/course/category/create', compact('categories', 'subCategories'));
    }

    public function edit(Category $category)
    {
        $categories = Category::where('id', '<>', $category->id)->where(function (Builder $builder) use ($category) {
            $builder->where('parent_id', '<>', $category->id)->orWhereNull('parent_id');
        })->get();

        $subCategories = Category::where(function (Builder $builder) use ($category) {
            $builder->whereNull('parent_id')
                    ->orWhere('parent_id', $category->id);
        })->whereNotIn('id', collect([$category->id, $category->parent_id])->filter()->toArray())->get();

        return view('admin/course/category/edit', compact('category', 'categories', 'subCategories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'unique:categories'],
            'icon' => ['image'],
            'image' => ['image'],
            'parent_id' => ['nullable', Rule::exists(Category::class, 'id')],
            'sub_categories.*' => [Rule::exists(Category::class, 'id')]
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

        DB::transaction(function () use ($data) {
            $subCategories = $data['sub_categories'] ?? null;
            unset($data['sub_categories']);

            $category = Category::create($data);

            $subCategories ? Category::whereIn('id', $subCategories ?? [])->update(['parent_id' => $category->id]) : null;
        });


        flash()->option('position', 'bottom-right')->success('Category store successfully!');

        return redirect()->to(route('admin.courses.categories.index'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'string', Rule::unique(Category::class)->ignoreModel($category)],
            'icon' => ['image'],
            'image' => ['image'],
            'parent_id' => ['nullable', Rule::exists(Category::class, 'id')],
            'sub_categories.*' => [Rule::exists(Category::class, 'id')]
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

        DB::transaction(function () use ($category, $data) {
            Category::where('parent_id', $category->id)->update(['parent_id' => null]);
            Category::whereIn('id', $data['sub_categories'] ?? [])->update(['parent_id' => $category->id]);
            unset($data['sub_categories']);
            $category->update($data);
        }, 3);

        flash()->option('position', 'bottom-right')->success('Category update successfully!');

        return redirect()->to(route('admin.courses.categories.index'));
    }

    public function destroy(Category $category)
    {
        $category->delete();

        $this->delete($category->getImage(), 'public');
        $this->delete($category->getImage('image'), 'public');

        flash()->option('position', 'bottom-right')->success('Category delete successfully!');

        return redirect()->to(route('admin.courses.categories.index'));
    }
}
