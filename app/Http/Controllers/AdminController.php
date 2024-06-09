<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function show()
    {
        return Inertia::render('admin/AdminDashboard');
    }

    public function usersIndex()
    {
        $users = User::all();
        return Inertia::render('admin/AdminUsersIndex', ['users' => $users]);
    }

    public function userShow()
    {
        $user = User::find(request()->id);
        return Inertia::render('admin/AdminUserShow', ['user' => $user]);
    }

    public function userEdit()
    {
        $user = User::findOrFail(request()->id);

        $rules = [
            'name' => ['required', 'string', 'max:100', 'min:8'],
            'avatar' => ['required', 'string', 'min:20', 'max:2000'],
        ];
        if (request()->email !== $user->email) {
            $rules['email'] = ['required', 'string', 'email', 'max:254', 'unique:users'];
        } else {
            request()->request->remove('email');
        }

        $attributes = request()->validate($rules);
        $user->update($attributes);

        return redirect()->route('admin-users-index');
    }


}
