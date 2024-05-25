<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;


class RefreshCategoriesController extends Controller
{
    public function __invoke()
    {

        $user = Auth::user();
        $bookmarks = Bookmark::with(['categories', 'user'])
            ->where('user_id', $user->id)
            ->get()
            ->pluck('categories')
            ->flatten()
            ->unique('name');

        return response()->json(['categories' => $bookmarks]);
    }
}
