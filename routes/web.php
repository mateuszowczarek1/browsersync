<?php

use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    if (Auth::user()) {
        return to_route('dashboard');
    }
    return Inertia::render('Home', [
        'user' => Auth::user(),
    ]);
})->name('Home');
Route::get('/dashboard', [BookmarkController::class, 'loadDashboard'])->name('dashboard')->middleware('auth');

#Auth
Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

Route::get('/login', [SessionController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [SessionController::class, 'store'])->middleware('guest');
Route::delete('/logout', [SessionController::class, 'destroy']);

#User Profile
Route::get('/user', [SessionController::class, 'show'])->middleware('auth');
Route::put('/user', [SessionController::class, 'update'])->middleware('auth');


#Bookmarks
Route::post('/bookmarks/add', [BookmarkController::class, 'store'])->middleware('auth');
Route::get('/bookmarks', [BookmarkController::class, 'loadEdit'])->middleware('auth')->name('list-bookmarks');
Route::get('/bookmarks/{bookmark}', [BookmarkController::class, 'edit'])->middleware('auth');
Route::patch('/bookmarks/{bookmark}', [BookmarkController::class, 'update'])->middleware('auth');
Route::delete('/bookmarks/{bookmark}', [BookmarkController::class, 'destroy'])->middleware('auth');
Route::get('/search', \App\Http\Controllers\SearchByNameController::class)->middleware('auth');



# Catalogues
Route::get('/catalogues', [CatalogueController::class, 'index'])->middleware('auth')->name('list-catalogues');
Route::get('/catalogues/add', [CatalogueController::class, 'create'])->middleware('auth')->name('create-catalogue');
Route::get('/catalogues/{catalogue}', [CatalogueController::class, 'show']);
Route::post('/catalogues/add', [CatalogueController::class, 'store'])->middleware('auth');
Route::get('/catalogues/edit/{catalogue}', [CatalogueController::class, 'edit'])->middleware('auth');
Route::put('/catalogues/edit/{catalogue}', [CatalogueController::class, 'update'])->middleware('auth');
Route::delete('/catalogues/edit/{catalogue}', [CatalogueController::class, 'destroy'])->middleware('auth');
