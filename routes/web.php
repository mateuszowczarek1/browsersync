<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', ['user' => ['firstName' => 'Robin', 'lastName' => 'Krystynovitz', 'age' => 12]]);
});
