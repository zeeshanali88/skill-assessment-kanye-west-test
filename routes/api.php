<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [\App\Http\Controllers\Api\UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('quotes', [\App\Http\Controllers\Api\QuotesController::class, 'index']);
    Route::get('favourite_quotes', [\App\Http\Controllers\Api\QuotesController::class, 'favourite_quotes']);
});
