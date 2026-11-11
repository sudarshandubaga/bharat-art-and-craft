<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Testimonial;

class AboutController extends Controller
{
    public function index()
    {
        $about = Page::where('slug', 'about-us')->first();
        $testimonials = Testimonial::latest()->take(6)->get();

        return view('about', compact('about', 'testimonials'));
    }

    /**
     * Dedicated SEO-Friendly Dynamic CMS Page: /page/{slug}
     */
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        return view('page', compact('page'));
    }
}
