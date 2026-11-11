<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Http\Requests\SliderRequest;
use App\Services\ImageOptimizer;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        $sliders = Slider::query();

        if (!empty($request->search_by_keyword)) {
            $keyword = $request->search_by_keyword;
            $sliders->where(function ($q) use ($keyword) {
                $q->where('title', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('description', 'LIKE', '%' . $keyword . '%');
            });
        }

        if (!empty($request->type) && $request->type === 'trash') {
            $sliders->onlyTrashed();
        }

        $sliders = $sliders->latest()->paginate(10);
        return view('admin.pages.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.pages.slider.create');
    }

    public function store(SliderRequest $request)
    {
        $slider = new Slider();
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->save();

        if ($request->hasFile('image') || $request->filled('image_base64')) {
            $imageSource = $request->hasFile('image') ? $request->file('image') : $request->input('image_base64');
            $filename = ImageOptimizer::processAndSave(
                $imageSource,
                public_path('images/sliders/'),
                (string)$slider->id,
                1920,
                800,
                public_path('images/sliders/thumbnail/'),
                200,
                100,
                85
            );

            if ($filename) {
                $slider->image = $filename;
                $slider->save();
            }
        }

        return redirect()->route('admin.slider.index')->with('success', 'Slider created successfully.');
    }

    public function edit(Request $request, Slider $slider)
    {
        return view('admin.pages.slider.edit', compact('slider'));
    }

    public function update(SliderRequest $request, Slider $slider)
    {
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->save();

        if ($request->hasFile('image') || $request->filled('image_base64')) {
            $imageSource = $request->hasFile('image') ? $request->file('image') : $request->input('image_base64');
            $filename = ImageOptimizer::processAndSave(
                $imageSource,
                public_path('images/sliders/'),
                (string)$slider->id,
                1920,
                800,
                public_path('images/sliders/thumbnail/'),
                200,
                100,
                85
            );

            if ($filename) {
                $slider->image = $filename;
                $slider->save();
            }
        }

        return redirect()->route('admin.slider.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $slider = Slider::withTrashed()->findOrFail($id);

        if ($request->action) {
            switch ($request->action) {
                case 'restore':
                    $slider->restore();
                    return redirect()->route('admin.slider.index')->with('success', 'Slider restored.');
                case 'permanent-delete':
                    ImageOptimizer::cleanOldFiles(public_path('images/sliders/'), (string)$slider->id);
                    ImageOptimizer::cleanOldFiles(public_path('images/sliders/thumbnail/'), (string)$slider->id);
                    $slider->forceDelete();
                    return redirect()->route('admin.slider.index')->with('success', 'Slider permanently deleted.');
            }
        } else {
            $slider->delete();
            return redirect()->back()->with('success', 'Slider moved to trash.');
        }
    }

    public function multiDelete(Request $request)
    {
        if (!empty($request->check)) {
            foreach ($request->check as $sliderId) {
                $slider = Slider::withTrashed()->find($sliderId);
                if ($slider) {
                    if ($request->action === 'permanent-delete') {
                        ImageOptimizer::cleanOldFiles(public_path('images/sliders/'), (string)$slider->id);
                        ImageOptimizer::cleanOldFiles(public_path('images/sliders/thumbnail/'), (string)$slider->id);
                        $slider->forceDelete();
                    } elseif ($request->action === 'restore') {
                        $slider->restore();
                    } else {
                        $slider->delete();
                    }
                }
            }
            return redirect()->back()->with('success', 'Selected sliders updated.');
        }

        return redirect()->back()->with('error', 'No sliders selected.');
    }
}

