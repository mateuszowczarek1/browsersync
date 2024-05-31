<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Catalogue;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CatalogueController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $user->load('catalogues');

        return Inertia::render('catalogues/CataloguesIndex', ['user' => $user]);
    }

    public function create()
    {
        return Inertia::render('catalogues/CreateCatalogue', ['user' => Auth::user()]);
    }

    public function store()
    {

        $validatedAttributes = request()->validate([
            'name' => ['required', 'min:5', 'max:150', 'string'],
            'isPublished' => ['required', 'boolean'],
        ]);

        $validatedAttributes['is_published'] = $validatedAttributes['isPublished'];
        unset($validatedAttributes['isPublished']);

        Auth::user()->catalogues()->create($validatedAttributes);

        return to_route('list-catalogues');
    }

    public function show(Catalogue $catalogue)
    {

        $catalogue = $catalogue->load(['user', 'bookmarks']);

        if (!$catalogue->is_published) {
            $catalogue->bookmarks = null;
        }

        return Inertia::render('catalogues/ShowCatalogue', ['catalogue' => $catalogue]);
    }

    public function edit(Catalogue $catalogue)
    {
        $user = Auth::user()->load('bookmarks');

        if ($user->id !== $catalogue->user_id) {
            abort(403, 'This catalogue does not belong to you. Go back now!');
        }

        return Inertia::render('catalogues/EditCatalogue', ['catalogue' => $catalogue->load('bookmarks'), 'bookmarks' => $user->bookmarks]);

    }

    public function update(Catalogue $catalogue)
    {
        $user = Auth::user();

        if ($user->id !== $catalogue->user_id) {
            abort(403, 'This catalogue does not belong to you. Go back now!');
        }

        $validatedAttributes = request()->validate([
            'name' => ['required', 'min:5', 'max:150', 'string'],
            'is_published' => ['required', 'boolean'],
        ]);

        $catalogue->update($validatedAttributes);
        $catalogue->bookmarks()->detach();

        foreach (request('bookmarks') as $bookmarkId) {
            $catalogue->bookmarks()->attach($bookmarkId);
        }

    $catalogue->save();

        return to_route('list-catalogues');
    }

    public function destroy(Catalogue $catalogue)
    {
        $user = Auth::user();

        if ($user->id !== $catalogue->user_id) {
            abort(403, 'This catalogue does not belong to you. Go back now!');
        }

        $catalogue->delete();

        return to_route('list-catalogues');
    }

    public function clone(Catalogue $catalogue)
    {
        if (!Gate::allows('clone-catalogue', $catalogue)) {
            abort(403, 'You cannot clone this catalogue. It has not been made public yet!');
        }

        $user = Auth::user();

        $newCatalogue = $user->catalogues()->create($catalogue->only('name', 'is_published'));

        foreach ($catalogue->bookmarks as $bookmark) {
            $existingBookmark = Bookmark::where('url', $bookmark->url)->where('user_id', $user->id)->first();
            if ($existingBookmark) {
                $newCatalogue->bookmarks()->attach($existingBookmark->id);
            } else {
                $newBookmarkData = $bookmark->only('name', 'url');
                $newBookmarkData['user_id'] = $user->id;
                $newCatalogue->bookmarks()->create($newBookmarkData);
            }
        }

        return to_route('list-catalogues');
    }
}
