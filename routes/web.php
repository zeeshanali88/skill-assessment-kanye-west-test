<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\QuoteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth'])->group(function () {
    Route::get('quotes', [QuoteController::class, 'index'])->name('quotes.index');
    Route::get('add/quote/{quote_id}/to_favourite', [QuoteController::class, 'AddQuoteToFavouriteList'])->name('add.quote.to_favourite');
    Route::get('favourite/quotes', [QuoteController::class, 'favouriteQuotes'])->name('favourite.quotes');
    Route::get('remove/quote/{quote_id}/from_favourites', [QuoteController::class, 'removeQuoteFromFavourites'])->name('favourite.quote.remove');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
