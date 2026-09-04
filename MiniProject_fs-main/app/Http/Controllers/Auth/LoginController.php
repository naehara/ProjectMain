<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Gunakan redirect() terus tanpa intended() untuk elak isu cached POST request
            return match ($user->role) {
                'admin'    => redirect('/admin/dashboard'),
                'lecturer' => redirect('/lecturer/dashboard'),
                'student'  => redirect('/student/dashboard'),
                default    => redirect()->route('login'),
            };
        }

        return back()->withErrors([
            'username' => 'Akaun tidak wujud atau maklumat salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}