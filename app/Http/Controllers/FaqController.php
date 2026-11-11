<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $faqs = Faq::query();

        if (!empty($request->search_by_keyword)) {
            $faqs->where(function ($q) use ($request) {
                $q->where('question', 'like', '%' . $request->search_by_keyword . '%')
                    ->orWhere('answer', 'like', '%' . $request->search_by_keyword . '%');
            });
        }

        if (!empty($request->type) && $request->type === 'trash') {
            $faqs->onlyTrashed();
        }

        $faqs = $faqs->orderBy('sort_order', 'asc')->latest()->paginate(10);

        return view('admin.pages.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.pages.faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:1000',
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer',
            'status' => 'nullable|in:active,inactive',
        ]);

        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->sort_order = $request->sort_order ?? 0;
        $faq->status = $request->status ?? 'active';
        $faq->save();

        return redirect()->route('admin.faq.index')->with('success', 'FAQ has been added successfully.');
    }

    public function edit(Request $request, Faq $faq)
    {
        return view('admin.pages.faq.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:1000',
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer',
            'status' => 'nullable|in:active,inactive',
        ]);

        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->sort_order = $request->sort_order ?? 0;
        $faq->status = $request->status ?? 'active';
        $faq->save();

        return redirect()->route('admin.faq.index')->with('success', 'FAQ has been updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $faq = Faq::withTrashed()->findOrFail($id);

        if ($request->action) {
            switch ($request->action) {
                case 'restore':
                    $faq->restore();
                    return redirect()->route('admin.faq.index')->with('success', 'FAQ has been restored.');
                case 'permanent-delete':
                    $faq->forceDelete();
                    return redirect()->route('admin.faq.index', ['type' => 'trash'])->with('success', 'FAQ permanently deleted.');
            }
        } else {
            $faq->delete();
            return redirect()->back()->with('success', 'FAQ moved to trash.');
        }
    }

    public function multiDelete(Request $request)
    {
        if (!empty($request->check)) {
            foreach ($request->check as $id) {
                $faq = Faq::withTrashed()->find($id);
                if ($faq) {
                    if ($request->action === 'permanent-delete') {
                        $faq->forceDelete();
                    } elseif ($request->action === 'restore') {
                        $faq->restore();
                    } else {
                        $faq->delete();
                    }
                }
            }
            return redirect()->back()->with('success', 'Selected FAQs updated successfully.');
        }

        return redirect()->back()->with('error', 'No items selected.');
    }
}

