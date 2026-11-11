<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\BlogRequest;
use App\Services\ImageOptimizer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::query();

        if (!empty($request->search_by_keyword)) {
            $keyword = $request->search_by_keyword;
            $blogs->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('excerpt', 'like', "%{$keyword}%");
            });
        }

        if (!empty($request->type) && $request->type === 'trash') {
            $blogs->onlyTrashed();
        }

        $blogs = $blogs->latest()->paginate(10);
        return view('admin.pages.blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.pages.blog.create');
    }

    public function store(BlogRequest $request)
    {
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = $request->slug ?: Str::slug($request->title);
        $blog->excerpt = $request->excerpt;
        $blog->save();

        if ($request->hasFile('image') || $request->filled('image_base64')) {
            $imageSource = $request->hasFile('image') ? $request->file('image') : $request->input('image_base64');
            $filename = ImageOptimizer::processAndSave(
                $imageSource,
                public_path('images/blogs/'),
                (string)$blog->id,
                1200,
                800,
                public_path('images/blogs/thumbnail/'),
                150,
                150,
                85
            );

            if ($filename) {
                $blog->image = $filename;
                $blog->save();
            }
        }

        return redirect()->route('admin.blog.index')->with('success', 'Blog article created successfully.');
    }

    public function edit(Request $request, Blog $blog)
    {
        return view('admin.pages.blog.edit', compact('blog'));
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        $blog->title = $request->title;
        $blog->slug = $request->slug ?: Str::slug($request->title);
        $blog->excerpt = $request->excerpt;
        $blog->save();

        if ($request->hasFile('image') || $request->filled('image_base64')) {
            $imageSource = $request->hasFile('image') ? $request->file('image') : $request->input('image_base64');
            $filename = ImageOptimizer::processAndSave(
                $imageSource,
                public_path('images/blogs/'),
                (string)$blog->id,
                1200,
                800,
                public_path('images/blogs/thumbnail/'),
                150,
                150,
                85
            );

            if ($filename) {
                $blog->image = $filename;
                $blog->save();
            }
        }

        return redirect()->route('admin.blog.index')->with('success', 'Blog article updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $blog = Blog::withTrashed()->findOrFail($id);

        if ($request->action) {
            switch ($request->action) {
                case 'restore':
                    $blog->restore();
                    return redirect()->route('admin.blog.index')->with('success', 'Blog article restored.');
                case 'permanent-delete':
                    ImageOptimizer::cleanOldFiles(public_path('images/blogs/'), (string)$blog->id);
                    ImageOptimizer::cleanOldFiles(public_path('images/blogs/thumbnail/'), (string)$blog->id);
                    $blog->forceDelete();
                    return redirect()->route('admin.blog.index')->with('success', 'Blog article permanently deleted.');
            }
        } else {
            $blog->delete();
            return redirect()->back()->with('success', 'Blog article moved to trash.');
        }
    }

    public function multiDelete(Request $request)
    {
        if (!empty($request->check)) {
            foreach ($request->check as $blogId) {
                $blog = Blog::withTrashed()->find($blogId);
                if ($blog) {
                    if ($request->action === 'permanent-delete') {
                        ImageOptimizer::cleanOldFiles(public_path('images/blogs/'), (string)$blog->id);
                        ImageOptimizer::cleanOldFiles(public_path('images/blogs/thumbnail/'), (string)$blog->id);
                        $blog->forceDelete();
                    } elseif ($request->action === 'restore') {
                        $blog->restore();
                    } else {
                        $blog->delete();
                    }
                }
            }
            return redirect()->back()->with('success', 'Selected blog articles updated.');
        }

        return redirect()->back()->with('error', 'No blog articles selected.');
    }
}

