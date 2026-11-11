<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\AdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $admins = Admin::query();

        if (!empty($request->search_by_keyword)) {
            $keyword = $request->search_by_keyword;
            $admins->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('first_name', 'like', "%{$keyword}%")
                    ->orWhere('last_name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        if (!empty($request->type) && $request->type === 'trash') {
            $admins->onlyTrashed();
        }

        $admins = $admins->latest()->paginate(10);
        return view('admin.pages.admin.index', compact('admins'));
    }

    public function create(Request $request)
    {
        return view('admin.pages.admin.create');
    }

    public function store(AdminRequest $request)
    {
        $admin = new Admin();
        $admin->title = $request->title;
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password ?? 'admin1234');
        $admin->phone = $request->phone;
        $admin->save();

        return redirect()->route('admin.admin.index')->with('success', 'Admin user created successfully.');
    }

    public function edit(Request $request, Admin $admin)
    {
        return view('admin.pages.admin.edit', compact('admin'));
    }

    public function update(AdminRequest $request, Admin $admin)
    {
        $admin->title = $request->title;
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->email = $request->email;

        if (!empty($request->password)) {
            $admin->password = Hash::make($request->password);
        }

        $admin->phone = $request->phone;
        $admin->save();

        return redirect()->route('admin.admin.index')->with('success', 'Admin user updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $admin = Admin::withTrashed()->findOrFail($id);

        if ($request->action) {
            switch ($request->action) {
                case 'restore':
                    $admin->restore();
                    return redirect()->route('admin.admin.index')->with('success', 'Admin user restored.');
                case 'permanent-delete':
                    $admin->forceDelete();
                    return redirect()->route('admin.admin.index')->with('success', 'Admin user permanently deleted.');
            }
        } else {
            $admin->delete();
            return redirect()->back()->with('success', 'Admin user moved to trash.');
        }
    }
}

