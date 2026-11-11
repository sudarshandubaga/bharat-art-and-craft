<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Testimonial;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        $categories = Category::withCount('products')
            ->orderBy('title')
            ->take(8)
            ->get();

        $featuredProducts = Product::with('category')
            ->where('featured_product', 'Y')
            ->latest()
            ->take(8)
            ->get();

        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::with('category')->latest()->take(8)->get();
        }

        $newArrivals = Product::with('category')->latest()->take(8)->get();
        $blogs = Blog::latest()->take(3)->get();
        $testimonials = Testimonial::latest()->take(6)->get();

        $allProducts = Product::with('category')->latest()->get();
        $frontendProducts = $allProducts->map(fn($p) => $p->toFrontendArray())->values();

        $promoSlides = $sliders->map(function ($s) {
            return [
                'image' => $s->image_url,
                'badge' => $s->excerpt ?: 'NEW COLLECTION',
                'title' => $s->title,
                'desc' => $s->description,
                'link' => route('shop'),
            ];
        })->values();

        return view('welcome', compact(
            'sliders',
            'categories',
            'featuredProducts',
            'newArrivals',
            'blogs',
            'testimonials',
            'frontendProducts',
            'promoSlides'
        ));
    }

    public function newsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:191',
        ]);

        Newsletter::firstOrCreate([
            'email' => $request->email,
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you for subscribing to our journal!',
            ]);
        }

        return redirect()->back()->with('success', 'Thank you for subscribing to our journal!');
    }
}

