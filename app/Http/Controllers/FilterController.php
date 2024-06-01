<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;


class FilterController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        $bookmarks = Bookmark::with(['categories', 'user'])
            ->where('user_id', $user->id)
            ->whereHas('categories', function ($query) {
                $query->where('name', request('category'));
            })
            ->get();

        return response()->json(['bookmarks' => $bookmarks]);
    }
}
