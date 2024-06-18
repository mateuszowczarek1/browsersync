<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookmarkRequest;
use App\Http\Requests\UpdateBookmarkRequest;
use App\Models\Bookmark;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;

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
        extract($this->index(true));

        return Inertia::render('Dashboard', ['bookmarks' => $bookmarks, 'user' => $user]);
    }

    public function loadEdit()
    {
        extract($this->index());
        return Inertia::render('auth/EditBookmarks', ['bookmarks' => $bookmarks, 'user' => $user]);
    }

    public function store(StoreBookmarkRequest $request)
    {

        $validated = $request->validated();

        $bookmark = Auth::user()->bookmarks()->create(['name' => $validated['name'], 'url' => $validated['url']]);

        $mainCategoryName = $validated['mainCategory'] ?? 'Uncategorized';
        $mainCategory = Category::firstOrCreate(['name' => $mainCategoryName]);

        $bookmark->categories()->attach($mainCategory);


        if (!empty($validated['newCategories'])) {
            foreach ($validated['newCategories'] as $newCategory) {
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

    public function update(UpdateBookmarkRequest $request, Bookmark $bookmark)
    {

        $bookmark->categories()->detach();

        foreach ($request->input('categories', []) as $newCategory) {
            if (strlen($newCategory) < 3 || strlen($newCategory) > 50) {
                continue;
            }
            $category = Category::firstOrCreate(['name' => $newCategory]);
            $bookmark->categories()->attach($category);
        }

        $bookmark->update($request->only(['name', 'url']));

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
