<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
        ], [
            'required' => ':attribute は必須です。',
        ], [
            'password' => 'パスワード',
        ]);

        if (Auth::attempt(['id' => 1, 'password' => $request->input('password')])) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.reservations.index'));
        }

        return back()->withErrors(['password' => 'パスワードが正しくありません。']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
