<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/get-states/{country}', function ($country) {
    // Replace this with your own logic to fetch the corresponding states for the selected country
    if ($country === 'Algeria') {
        return ['Algiers', 'Oran'];
    } elseif ($country === 'England') {
        return ['London', 'Manchester'];
    }

    return [];
});

Route::get('/', function () {
    return view('search');
});

Route::get('/create', function () {
    return view('create');
});
Route::get('/search', [SearchController::class, 'search'])->name('apartment.search');

Route::post('/store', [SearchController::class, 'store'])->name('apartment.store');
