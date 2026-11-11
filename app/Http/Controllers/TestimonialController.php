<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Http\Requests\TestimonialRequest;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $testimonials = Testimonial::query();

        if (!empty($request->search_by_keyword)) {
            $keyword = $request->search_by_keyword;
            $testimonials->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('remark', 'like', "%{$keyword}%");
            });
        }

        if (!empty($request->type) && $request->type === 'trash') {
            $testimonials->onlyTrashed();
        }

        $testimonials = $testimonials->latest()->paginate(10);
        return view('admin.pages.testimonial.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.pages.testimonial.create');
    }

    public function store(TestimonialRequest $request)
    {
        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->remark = $request->remark;
        $testimonial->save();

        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial created successfully.');
    }

    public function edit(Request $request, Testimonial $testimonial)
    {
        return view('admin.pages.testimonial.edit', compact('testimonial'));
    }

    public function update(TestimonialRequest $request, Testimonial $testimonial)
    {
        $testimonial->name = $request->name;
        $testimonial->remark = $request->remark;
        $testimonial->save();

        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $testimonial = Testimonial::withTrashed()->findOrFail($id);

        if ($request->action) {
            switch ($request->action) {
                case 'restore':
                    $testimonial->restore();
                    return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial restored.');
                case 'permanent-delete':
                    $testimonial->forceDelete();
                    return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial permanently deleted.');
            }
        } else {
            $testimonial->delete();
            return redirect()->back()->with('success', 'Testimonial moved to trash.');
        }
    }

    public function multiDelete(Request $request)
    {
        if (!empty($request->check)) {
            foreach ($request->check as $testimonialId) {
                $testimonial = Testimonial::withTrashed()->find($testimonialId);
                if ($testimonial) {
                    if ($request->action === 'permanent-delete') {
                        $testimonial->forceDelete();
                    } elseif ($request->action === 'restore') {
                        $testimonial->restore();
                    } else {
                        $testimonial->delete();
                    }
                }
            }
            return redirect()->back()->with('success', 'Selected testimonials updated.');
        }

        return redirect()->back()->with('error', 'No testimonials selected.');
    }
}

