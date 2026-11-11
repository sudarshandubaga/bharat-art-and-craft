<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $newsletters = Newsletter::query();

        if (!empty($request->type) && $request->type === 'trash') {
            $newsletters->onlyTrashed();
        }

        $newsletters = $newsletters->latest()->paginate(10);
        return view('admin.pages.newsletter.index', compact('newsletters'));
    }

    public function create(Request $request)
    {
        return view('admin.pages.newsletter.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);

        $newsletter = new Newsletter();
        $newsletter->email = $request->email;
        $newsletter->save();

        return redirect()->route('admin.newsletter.index')->with('success', 'Newsletter subscriber added.');
    }

    public function destroy(Request $request, $id)
    {
        $newsletter = Newsletter::withTrashed()->findOrFail($id);
        $newsletter->delete();

        return redirect()->back()->with('success', 'Subscriber removed.');
    }
}

