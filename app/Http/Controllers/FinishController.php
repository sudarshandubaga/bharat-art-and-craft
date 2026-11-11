<?php

namespace App\Http\Controllers;

use App\Models\Finish;
use App\Http\Requests\FinishRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FinishController extends Controller
{
    public function index(Request $request)
    {
        $finishes = Finish::query();

        if (!empty($request->search_by_keyword)) {
            $finishes->where('name', 'like', '%' . $request->search_by_keyword . '%');
        }

        if (!empty($request->type) && $request->type === 'trash') {
            $finishes->onlyTrashed();
        }

        $finishes = $finishes->latest()->paginate(10);
        return view('admin.pages.finish.index', compact('finishes'));
    }

    public function create()
    {
        return view('admin.pages.finish.create');
    }

    public function store(FinishRequest $request)
    {
        $finish = new Finish();
        $finish->name = $request->name;
        $finish->slug = $request->slug ?: Str::slug($request->name);
        $finish->status = $request->status ?? 'active';
        $finish->save();

        return redirect()->route('admin.finish.index')->with('success', 'Finish has been saved successfully.');
    }

    public function edit(Request $request, Finish $finish)
    {
        return view('admin.pages.finish.edit', compact('finish'));
    }

    public function update(FinishRequest $request, Finish $finish)
    {
        $finish->name = $request->name;
        $finish->slug = $request->slug ?: Str::slug($request->name);
        if ($request->has('status')) {
            $finish->status = $request->status;
        }
        $finish->save();

        return redirect()->route('admin.finish.index')->with('success', 'Finish has been updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $finish = Finish::withTrashed()->findOrFail($id);

        if ($request->action) {
            switch ($request->action) {
                case 'restore':
                    $finish->restore();
                    return redirect()->route('admin.finish.index')->with('success', 'Finish has been restored.');
                case 'permanent-delete':
                    $finish->forceDelete();
                    return redirect()->route('admin.finish.index')->with('success', 'Finish permanently deleted.');
            }
        } else {
            $finish->delete();
            return redirect()->back()->with('success', 'Finish moved to trash.');
        }
    }

    public function multiDelete(Request $request)
    {
        if (!empty($request->check)) {
            foreach ($request->check as $id) {
                $finish = Finish::withTrashed()->find($id);
                if ($finish) {
                    if ($request->action === 'permanent-delete') {
                        $finish->forceDelete();
                    } elseif ($request->action === 'restore') {
                        $finish->restore();
                    } else {
                        $finish->delete();
                    }
                }
            }
            return redirect()->back()->with('success', 'Selected finishes updated successfully.');
        }

        return redirect()->back()->with('error', 'No finishes selected.');
    }
}
