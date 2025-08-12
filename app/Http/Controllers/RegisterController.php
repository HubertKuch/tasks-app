<?php

namespace App\Http\Controllers;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'password_conf' => ['required']
        ]);

        $probUser = User::firstWhere('email', $data['email']);

        if ($probUser != null) {
            return back()->withErrors(['error' => 'Your account already exists']);
        }

        if ($data['password'] !== $data['password_conf']) {
            return back()->withErrors(['error' => 'Password must be the same']);
        }

        User::factory()
            ->make(['email' => $data['email'], "password" => $data["password"]])
            ->save();

        return redirect('/register-success');
    }
}
