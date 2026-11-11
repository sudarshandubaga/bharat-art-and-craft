<?php

namespace App\Http\Controllers;

use App\Models\Wood;
use App\Http\Requests\WoodRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WoodController extends Controller
{
    public function index(Request $request)
    {
        $woods = Wood::query();

        if (!empty($request->search_by_keyword)) {
            $woods->where('name', 'like', '%' . $request->search_by_keyword . '%');
        }

        if (!empty($request->type) && $request->type === 'trash') {
            $woods->onlyTrashed();
        }

        $woods = $woods->latest()->paginate(10);
        return view('admin.pages.wood.index', compact('woods'));
    }

    public function create()
    {
        return view('admin.pages.wood.create');
    }

    public function store(WoodRequest $request)
    {
        $wood = new Wood();
        $wood->name = $request->name;
        $wood->slug = $request->slug ?: Str::slug($request->name);
        $wood->status = $request->status ?? 'active';
        $wood->save();

        return redirect()->route('admin.wood.index')->with('success', 'Wood has been saved successfully.');
    }

    public function edit(Request $request, Wood $wood)
    {
        return view('admin.pages.wood.edit', compact('wood'));
    }

    public function update(WoodRequest $request, Wood $wood)
    {
        $wood->name = $request->name;
        $wood->slug = $request->slug ?: Str::slug($request->name);
        if ($request->has('status')) {
            $wood->status = $request->status;
        }
        $wood->save();

        return redirect()->route('admin.wood.index')->with('success', 'Wood has been updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $wood = Wood::withTrashed()->findOrFail($id);

        if ($request->action) {
            switch ($request->action) {
                case 'restore':
                    $wood->restore();
                    return redirect()->route('admin.wood.index')->with('success', 'Wood has been restored.');
                case 'permanent-delete':
                    $wood->forceDelete();
                    return redirect()->route('admin.wood.index')->with('success', 'Wood permanently deleted.');
            }
        } else {
            $wood->delete();
            return redirect()->back()->with('success', 'Wood moved to trash.');
        }
    }

    public function multiDelete(Request $request)
    {
        if (!empty($request->check)) {
            foreach ($request->check as $id) {
                $wood = Wood::withTrashed()->find($id);
                if ($wood) {
                    if ($request->action === 'permanent-delete') {
                        $wood->forceDelete();
                    } elseif ($request->action === 'restore') {
                        $wood->restore();
                    } else {
                        $wood->delete();
                    }
                }
            }
            return redirect()->back()->with('success', 'Selected woods updated successfully.');
        }

        return redirect()->back()->with('error', 'No woods selected.');
    }
}
