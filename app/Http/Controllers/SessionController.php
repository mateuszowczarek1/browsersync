<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;


class SessionController extends Controller
{

    public function create()
    {
        if (Auth::user()) {
            return to_route('Home');
        }
        return Inertia::render("auth/Login");
    }
    public function destroy()
    {
        Auth::logout();
        return to_route('Home');
    }

    public function store()
    {
        $attributes = request()->validate(['email' => ['required', 'email'], 'password' => ['required']]);

        if (!Auth::attempt($attributes)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'These credentials do not match our records.',
                'password' => 'Provide password and try again.',
            ]);
        }

        request()->session()->regenerate();

        return to_route('dashboard');
    }

    public function update(){
        $user = Auth::user();
        $validatedAttributes = request()->validate([
            'name' => ['required', 'string', 'max:100', 'min:8'],
            'avatar' => ['required', 'string', 'min:20', 'max:2000'],
            'password' => ['required', Password::min(5)->max(100)],
        ]);

        if (isset($validatedAttributes['password'])) {
            $user->password = Hash::make($validatedAttributes['password']);
        }

        $user-> name = $validatedAttributes['name'];
        $user->avatar = $validatedAttributes['avatar'];

        $user->save();

        return to_route('Home');
    }

    public function show(){
        return Inertia::render("auth/EditUser", ['user' => Auth::user()]);
    }
}
