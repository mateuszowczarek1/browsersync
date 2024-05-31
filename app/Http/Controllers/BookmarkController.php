<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class BookmarkController extends Controller
{
    public function index($paginate = false)
    {
        $user = Auth::user();
        $query = $user->bookmarks()->with('categories')->where('is_visible', true)->latest();

        if ($paginate) {
            $bookmarks = $query->paginate(15);
        } else {
            $bookmarks = $query->get();
        }

        $bookmarks->load('categories');

        return ['bookmarks' => $bookmarks, 'user' => $user];
    }

    public function loadDashboard()
    {
        extract($this->index(false));

        return Inertia::render('Dashboard', ['bookmarks' => $bookmarks, 'user' => $user]);
    }

    public function loadEdit()
    {
        extract($this->index());
        return Inertia::render('auth/EditBookmarks', ['bookmarks' => $bookmarks, 'user' => $user]);
    }

    public function store()
    {

        request()->validate([
            'name' => ['required', 'min:5', 'max:100', 'string'],
            'url' => ['required', 'min:10', 'max:500', 'string'],
        ]);

        $bookmark = Auth::user()->bookmarks()->create(['name' => request('name'), 'url' => request('url')]);

        if (request()->has('mainCategory') && request('mainCategory') !== null) {

            $mainCategory = Category::firstOrCreate(['name' => request('mainCategory')]);

            $bookmark->categories()->attach($mainCategory);
        }

        if (request()->has('newCategories') && is_array(request('newCategories'))) {
            foreach (request('newCategories') as $newCategory) {
                if (strlen($newCategory) < 3 || strlen($newCategory) > 50) {
                    continue;
                }
                $category = Category::firstOrCreate(['name' => $newCategory]);
                $bookmark->categories()->attach($category);
            }
        }

        return;
    }

    public function edit(Bookmark $bookmark)
    {
        if (!Gate::allows('edit-bookmark', $bookmark)) {
            abort(403, 'This bookmark does not belong to you. Go back now!');
        }
        $bookmark = $bookmark->load('categories');
        return Inertia::render('auth/ShowBookmark', ['bookmark' => $bookmark, 'user_id' => Auth::user()->id]);
    }

    public function update(Bookmark $bookmark)
    {
        if (!Gate::allows('edit-bookmark', $bookmark)) {
            abort(403, 'This bookmark does not belong to you. Go back now!');
        }

        request()->validate([
            'name' => ['required', 'min:5', 'max:100', 'string'],
            'url' => ['required', 'min:10', 'max:500', 'string'],
        ]);

        $bookmark->categories()->detach();

        foreach (request('categories') as $newCategory) {
            if (strlen($newCategory) < 3 || strlen($newCategory) > 50) {
                continue;
            }
            $category = Category::firstOrCreate(['name' => $newCategory]);
            $bookmark->categories()->attach($category);
        }

        $bookmark->update(['name' => request('name'), 'url' => request('url')]);

        return to_route('list-bookmarks');
    }

    public function destroy(Bookmark $bookmark)
    {
        if ($bookmark->user_id !== Auth::user()->id) {
            abort(403, 'This bookmark does not belong to you. Go back now!');
        }

        $bookmark->is_visible = false;
        $bookmark->save();

        return to_route('list-bookmarks');
    }
}
