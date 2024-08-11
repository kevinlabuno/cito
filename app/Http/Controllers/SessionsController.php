<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

public function store()
{
    $attributes = request()->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Cek apakah pengguna aktif
    $user = User::where('email', $attributes['email'])->first();

    if ($user && $user->status != 1) {
        return back()->withErrors(['email' => 'Your account is not active.']);
    }

    // Coba untuk login
    if (Auth::attempt($attributes)) {
        session()->regenerate();
        return redirect('beranda')->with(['success' => 'You are logged in.']);
    } else {
        return back()->withErrors(['email' => 'Email or password invalid.']);
    }
}

    
    public function destroy()
    {

        Auth::logout();

        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }
}
