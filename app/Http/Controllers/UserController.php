<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query();

        if (!empty($request->search_by_keyword)) {
            $keyword = $request->search_by_keyword;
            $users->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%")
                    ->orWhere('first_name', 'like', "%{$keyword}%")
                    ->orWhere('last_name', 'like', "%{$keyword}%");
            });
        }

        if (!empty($request->type) && $request->type === 'trash') {
            $users->onlyTrashed();
        }

        $users = $users->latest()->paginate(10);
        return view('admin.pages.user.index', compact('users'));
    }

    public function create(Request $request)
    {
        return view('admin.pages.user.create');
    }

    public function store(UserRequest $request)
    {
        $user = new User();
        $user->title = $request->title ?? 'Mr.';
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = trim(($request->first_name ?? '') . ' ' . ($request->last_name ?? ''));
        $user->email = $request->email;
        $user->password = Hash::make($request->password ?? '123456');
        $user->phone = $request->phone;
        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'User has been saved successfully.');
    }

    public function edit(Request $request, User $user)
    {
        return view('admin.pages.user.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->title = $request->title;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = trim(($request->first_name ?? '') . ' ' . ($request->last_name ?? ''));
        $user->email = $request->email;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->phone = $request->phone;
        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'User has been updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $user = User::withTrashed()->findOrFail($id);

        if ($request->action) {
            switch ($request->action) {
                case 'restore':
                    $user->restore();
                    return redirect()->route('admin.user.index')->with('success', 'User has been restored.');
                case 'permanent-delete':
                    $user->forceDelete();
                    return redirect()->route('admin.user.index')->with('success', 'User permanently deleted.');
            }
        } else {
            $user->delete();
            return redirect()->back()->with('success', 'User moved to trash.');
        }
    }
}

