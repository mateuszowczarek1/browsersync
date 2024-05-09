<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookmarkRequest;
use App\Http\Requests\UpdateBookmarkRequest;
use App\Models\Bookmark;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $bookmarks = $user->bookmarks()->with('categories')->latest()->paginate(15);

        $bookmarks->load('categories');

        return Inertia::render('Dashboard', ['bookmarks' => $bookmarks, 'user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {



    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        request()->validate([
            'name' => ['required', 'min:5', 'max:100'],
            'url' => ['required', 'min:10', 'max:500']
        ]);

        $bookmark = Bookmark::create([
            'name' => request('name'),
            'url' => request('url'),
            'user_id' => request('userId')
        ]);

        $uncategorizedCategory = Category::firstOrCreate(['name' => 'uncategorized']);

        $bookmark->categories()->attach($uncategorizedCategory);






        return;
    }

    /**
     * Display the specified resource.
     */
    public function show(Bookmark $bookmark)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bookmark $bookmark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookmarkRequest $request, Bookmark $bookmark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bookmark $bookmark)
    {
        //
    }
}
