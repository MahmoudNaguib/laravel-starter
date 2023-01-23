<?php

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
Route::resource('translations', \App\Http\Controllers\Api\TranslationsController::class);
Route::group(['prefix' => (app()->environment() == 'testing') ? 'en' : setlang(), 'middleware' => ['ApiLocalization']], function () {
    AdvancedRoute::controller('auth', \App\Http\Controllers\Api\AuthController::class);
    AdvancedRoute::controller('configs', \App\Http\Controllers\Api\ConfigsController::class);
    Route::resource('posts', \App\Http\Controllers\Api\PostsController::class);

    Route::group(['middleware' => ['auth']], function () {
        AdvancedRoute::controller('profile', \App\Http\Controllers\Api\Logged\ProfileController::class);

        Route::get('notifications/unseen-count', [\App\Http\Controllers\Api\Logged\NotificationsController::class, 'getUnseenCount']);

        Route::get('notifications/delete-all', [\App\Http\Controllers\Api\Logged\NotificationsController::class, 'getDeleteAll']);

        Route::get('notifications/see-all', [\App\Http\Controllers\Api\Logged\NotificationsController::class, 'getSeeAll']);

        Route::resource('notifications', \App\Http\Controllers\Api\Logged\NotificationsController::class);

        Route::group(['middleware' => ['GuestUser']], function () {
            Route::resource('my-posts', \App\Http\Controllers\Api\Logged\MyPostsController::class);
        });

    });

});

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
