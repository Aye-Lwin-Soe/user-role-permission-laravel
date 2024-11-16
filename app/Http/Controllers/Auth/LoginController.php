<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->is_active == 0) {
                Auth::logout();

                return redirect()->back()->withErrors(['email' => 'Your account is inactive. Please contact support.']);
            }
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['email' => 'These credentials do not match our records.']);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
