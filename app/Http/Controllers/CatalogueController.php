<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCatalogueRequest;
use App\Http\Requests\UpdateCatalogueRequest;
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Catalogue $catalogue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCatalogueRequest $request, Catalogue $catalogue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Catalogue $catalogue)
    {
        //
    }
}
