<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password) && $user->is_admin) {
            Auth::login($user);
            return redirect()->intended('/admin/secure-page');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials or not an admin.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
