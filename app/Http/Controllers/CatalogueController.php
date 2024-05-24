<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CatalogueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $user->load('catalogues');

        return Inertia::render('catalogues/CataloguesIndex', ['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('catalogues/CreateCatalogue', ['user' => Auth::user()]);
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(Catalogue $catalogue)
    {


        $catalogue = $catalogue->load(['user', 'bookmarks']);

        if (!$catalogue->is_published) {
            $catalogue->bookmarks = null;
        }

        return Inertia::render('catalogues/ShowCatalogue', ['catalogue' => $catalogue]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Catalogue $catalogue)
    {
        $user = Auth::user()->load('bookmarks');

        if ($user->id !== $catalogue->user_id) {
            abort(403, 'This catalogue does not belong to you. Go back now!');
        }

        return Inertia::render('catalogues/EditCatalogue', ['catalogue' => $catalogue->load('bookmarks'), 'bookmarks' => $user->bookmarks]);

    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Catalogue $catalogue)
    {
        $user = Auth::user();

        if ($user->id !== $catalogue->user_id) {
            abort(403, 'This catalogue does not belong to you. Go back now!');
        }

        $catalogue->delete();

        return to_route('list-catalogues');
    }
}
