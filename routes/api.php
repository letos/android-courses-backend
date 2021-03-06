<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
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


Route::middleware('auth:api')->group(function () {

    Route::get('/items', [ItemsController::class, 'index']);
    Route::post('/items/import', [ItemsController::class, 'import']);

    Route::post('/favorites/{id}', [FavoriteController::class, 'create']);
    Route::delete('/favorites/{id}', [FavoriteController::class, 'delete']);

    Route::post('/ratings/{id}/like', [RatingController::class, 'like']);
    Route::post('/ratings/{id}/dislike', [RatingController::class, 'dislike']);
    Route::delete('/ratings/{id}', [RatingController::class, 'delete']);

    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users/avatar', [UserController::class, 'avatar']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
