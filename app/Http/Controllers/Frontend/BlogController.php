<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $featuredBlog = Blog::latest()->first();

        $blogsQuery = Blog::query();
        if ($featuredBlog) {
            $blogsQuery->where('id', '!=', $featuredBlog->id);
        }

        if ($request->filled('search')) {
            $s = $request->input('search');
            $blogsQuery->where(function ($q) use ($s) {
                $q->where('title', 'like', "%{$s}%")
                    ->orWhere('excerpt', 'like', "%{$s}%")
                    ->orWhere('description', 'like', "%{$s}%");
            });
        }

        $blogs = $blogsQuery->latest()->paginate(8);
        $recentBlogs = Blog::latest()->take(4)->get();

        return view('blog.index', compact('featuredBlog', 'blogs', 'recentBlogs'));
    }

    public function post($slug = null)
    {
        $blog = null;
        if (!empty($slug)) {
            $blog = Blog::where('slug', $slug)->orWhere('id', $slug)->first();
        }

        if (!$blog) {
            $blog = Blog::latest()->first();
        }

        $recentBlogs = collect();
        if ($blog) {
            $recentBlogs = Blog::where('id', '!=', $blog->id)->latest()->take(3)->get();
        }

        return view('blog.post', compact('blog', 'recentBlogs', 'slug'));
    }
}

