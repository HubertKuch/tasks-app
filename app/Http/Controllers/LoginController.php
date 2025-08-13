<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function authenticate(Request $req): RedirectResponse
    {
        $credentials = $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();

            return redirect('/', 301);
        }

        return back()->withErrors("Email or password are invalid");
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
