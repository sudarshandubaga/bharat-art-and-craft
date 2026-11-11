<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.pages.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $cred = $request->only(['email', 'password']);

        if (Auth::guard('admin')->attempt($cred, (bool)$request->remember_me)) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->withInput()->with('danger', 'Invalid Email or Password.');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }
}

