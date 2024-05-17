<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SearchByNameController extends Controller
{
    public function __invoke()
    {

        $user = Auth::user();
        $bookmarks = Bookmark::with(['categories', 'user'])
            ->where('user_id', $user->id)
            ->where('name', 'LIKE', '%' . request('q') . '%')
            ->get();

        return Inertia::render('Search', ['bookmarks' => $bookmarks, 'user' => $user]);
    }
}
