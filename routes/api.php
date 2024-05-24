<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Authors
Route::prefix('authors')->group(function () {
    Route::post('/', \App\Http\Controllers\Api\V1\Author\StoreController::class);
    Route::get('/', \App\Http\Controllers\Api\V1\Author\IndexController::class);
    Route::get('/{author}', \App\Http\Controllers\Api\V1\Author\ShowController::class);
    Route::put('/{author}', \App\Http\Controllers\Api\V1\Author\UpdateController::class);
    Route::delete('/{author}', \App\Http\Controllers\Api\V1\Author\DeleteController::class);
});


//Books
Route::prefix('books')->group(function () {
    Route::post('/', \App\Http\Controllers\Api\V1\Book\StoreController::class);
    Route::get('/', \App\Http\Controllers\Api\V1\Book\IndexController::class);
    Route::get('/{book}', \App\Http\Controllers\Api\V1\Book\ShowController::class);
    Route::put('/{book}', \App\Http\Controllers\Api\V1\Book\UpdateController::class);
    Route::delete('/{book}', \App\Http\Controllers\Api\V1\Book\DeleteController::class);
    Route::get('/search/{author_last_name}', \App\Http\Controllers\Api\V1\Book\SearchController::class);
});
