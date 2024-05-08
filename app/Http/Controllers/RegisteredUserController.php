<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    public function create()
    {
        if (Auth::user()) {
            return to_route('Home');
        }
        return Inertia::render('auth/Register');
    }

    public function store(Request $request)
    {

        $validatedAttributes = $request->validate([
            'name' => ['required', 'string', 'max:100', 'min:8'],
            'email' => ['required', 'string', 'email', 'max:254', 'unique:users'],
            'avatar' => ['required', 'string', 'min:20', 'max:500'],
            'password' => ['required', Password::min(5)->max(100)],
        ]);

        $user = User::create($validatedAttributes);

        Auth::login($user);
        return to_route('dashboard');

    }
}
