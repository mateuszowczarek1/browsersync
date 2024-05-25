<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;


class SearchController extends Controller
{
    public function __invoke()
    {

        $user = Auth::user();
        $bookmarks = Bookmark::with(['categories', 'user'])
            ->where('user_id', $user->id)
            ->where('name', 'LIKE', '%' . request('q') . '%')
            ->get();

        return response()->json(['bookmarks' => $bookmarks]);
    }
}
