<?php

namespace App\Http\Controllers;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function show()
    {
        return Inertia::render('admin/AdminDashboard');
    }

}
