<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Http\Requests\PageRequest;
use App\Services\ImageOptimizer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $pages = Page::query();

        if (!empty($request->search_by_keyword)) {
            $keyword = $request->search_by_keyword;
            $pages->where(function ($q) use ($keyword) {
                $q->where('title', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('excerpt', 'LIKE', '%' . $keyword . '%');
            });
        }

        if (!empty($request->type) && $request->type === 'trash') {
            $pages->onlyTrashed();
        }

        $pages = $pages->latest()->paginate(10);
        return view('admin.pages.page.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.page.create');
    }

    public function store(PageRequest $request)
    {
        $page = new Page();
        $page->title = $request->title;
        $page->slug = $request->slug ?: Str::slug($request->title);
        $page->excerpt = $request->excerpt;
        $page->save();

        if ($request->hasFile('image') || $request->filled('image_base64')) {
            $imageSource = $request->hasFile('image') ? $request->file('image') : $request->input('image_base64');
            $filename = ImageOptimizer::processAndSave(
                $imageSource,
                public_path('images/pages/'),
                (string)$page->id,
                1200,
                800,
                public_path('images/pages/thumbnail/'),
                150,
                150,
                85
            );

            if ($filename) {
                $page->image = $filename;
                $page->save();
            }
        }

        return redirect()->route('admin.page.index')->with('success', 'Page created successfully.');
    }

    public function edit(Request $request, Page $page)
    {
        return view('admin.pages.page.edit', compact('page'));
    }

    public function update(PageRequest $request, Page $page)
    {
        $page->title = $request->title;
        $page->slug = $request->slug ?: Str::slug($request->title);
        $page->excerpt = $request->excerpt;
        $page->save();

        if ($request->hasFile('image') || $request->filled('image_base64')) {
            $imageSource = $request->hasFile('image') ? $request->file('image') : $request->input('image_base64');
            $filename = ImageOptimizer::processAndSave(
                $imageSource,
                public_path('images/pages/'),
                (string)$page->id,
                1200,
                800,
                public_path('images/pages/thumbnail/'),
                150,
                150,
                85
            );

            if ($filename) {
                $page->image = $filename;
                $page->save();
            }
        }

        return redirect()->route('admin.page.index')->with('success', 'Page updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $page = Page::withTrashed()->findOrFail($id);

        if ($request->action) {
            switch ($request->action) {
                case 'restore':
                    $page->restore();
                    return redirect()->route('admin.page.index')->with('success', 'Page restored.');
                case 'permanent-delete':
                    ImageOptimizer::cleanOldFiles(public_path('images/pages/'), (string)$page->id);
                    ImageOptimizer::cleanOldFiles(public_path('images/pages/thumbnail/'), (string)$page->id);
                    $page->forceDelete();
                    return redirect()->route('admin.page.index')->with('success', 'Page permanently deleted.');
            }
        } else {
            $page->delete();
            return redirect()->back()->with('success', 'Page moved to trash.');
        }
    }

    public function multiDelete(Request $request)
    {
        if (!empty($request->check)) {
            foreach ($request->check as $pageId) {
                $page = Page::withTrashed()->find($pageId);
                if ($page) {
                    if ($request->action === 'permanent-delete') {
                        ImageOptimizer::cleanOldFiles(public_path('images/pages/'), (string)$page->id);
                        ImageOptimizer::cleanOldFiles(public_path('images/pages/thumbnail/'), (string)$page->id);
                        $page->forceDelete();
                    } elseif ($request->action === 'restore') {
                        $page->restore();
                    } else {
                        $page->delete();
                    }
                }
            }
            return redirect()->back()->with('success', 'Selected pages updated.');
        }

        return redirect()->back()->with('error', 'No pages selected.');
    }
}

