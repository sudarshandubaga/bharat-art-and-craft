<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::query();

        if (!empty($request->search_by_keyword)) {
            $categories->where('title', 'like', '%' . $request->search_by_keyword . '%');
        }

        if (!empty($request->type) && $request->type === 'trash') {
            $categories->onlyTrashed();
        }

        $categories = $categories->latest()->paginate(10);
        return view('admin.pages.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.pages.category.create');
    }

    public function store(CategoryRequest $request)
    {
        $category = new Category();
        $category->title = $request->title;
        $category->slug = $request->slug ?: Str::slug($request->title);
        $category->category_id = null;
        $category->description = $request->description;
        $category->seo_title = $request->seo_title;
        $category->seo_keywords = $request->seo_keywords;
        $category->seo_description = $request->seo_description;
        $category->save();

        return redirect()->route('admin.category.index')->with('success', 'Category has been saved.');
    }

    public function edit(Request $request, Category $category)
    {
        return view('admin.pages.category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->title = $request->title;
        $category->slug = $request->slug ?: Str::slug($request->title);
        $category->category_id = null;
        $category->description = $request->description;
        $category->seo_title = $request->seo_title;
        $category->seo_keywords = $request->seo_keywords;
        $category->seo_description = $request->seo_description;
        $category->save();

        return redirect()->route('admin.category.index')->with('success', 'Category has been updated.');
    }

    public function destroy(Request $request, $id)
    {
        $category = Category::withTrashed()->findOrFail($id);

        if ($request->action) {
            switch ($request->action) {
                case 'restore':
                    $category->restore();
                    return redirect()->route('admin.category.index')->with('success', 'Category has been restored.');
                case 'permanent-delete':
                    $category->forceDelete();
                    return redirect()->route('admin.category.index')->with('success', 'Category permanently deleted.');
            }
        } else {
            $category->delete();
            return redirect()->back()->with('success', 'Category moved to trash.');
        }
    }

    public function multiDelete(Request $request)
    {
        if (!empty($request->check)) {
            foreach ($request->check as $categoryId) {
                $category = Category::withTrashed()->find($categoryId);
                if ($category) {
                    if ($request->action === 'permanent-delete') {
                        $category->forceDelete();
                    } elseif ($request->action === 'restore') {
                        $category->restore();
                    } else {
                        $category->delete();
                    }
                }
            }
            return redirect()->back()->with('success', 'Selected categories updated.');
        }

        return redirect()->back()->with('error', 'No categories selected.');
    }
}

