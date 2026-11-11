<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Page;

class FaqController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'faq')->first();
        $faqs = Faq::where('status', 'active')->orderBy('sort_order', 'asc')->get();

        return view('faqs', compact('page', 'faqs'));
    }
}

