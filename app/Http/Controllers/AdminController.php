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
        return Inertia::render('admin/AdminUsersIndex', ['users'=> $users]);
    }

    public function userShow()
    {
        $user = User::find(request()->user()->id);
        return $user;
    }

}
