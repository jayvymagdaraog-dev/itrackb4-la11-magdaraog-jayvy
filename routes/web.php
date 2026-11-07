<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/whoami', function () {
    return 'Jayvy P. Magdaraog | 2023-70362 | Block 4C | ITRACKB4 Laravel 12';
});

Route::get('/movies/featured', [MovieController::class, 'featured'])->name('movies.featured');

Route::get('/movies/filter/{year?}', function ($year = null) {
    return redirect()->route('movies.index', $year ? ['year' => $year] : []);
});

Route::resource('movies', MovieController::class);