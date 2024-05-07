<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class SessionController extends Controller
{

    public function create()
    {
        return Inertia::render("auth/Login");
    }
    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }

    public function store()
    {
        $attributes = request()->validate(['email' =>['required', 'email'], 'password' =>['required']]);

       if(!Auth::attempt($attributes))
       {
           throw \Illuminate\Validation\ValidationException::withMessages([
               'email' => 'These credentials do not match our records.',
               'password' => 'Provide password and try again.',
           ]);
       }

        request()->session()->regenerate();

        return redirect('/');
    }
}
