<?php


use App\Http\Controllers\Recruiter\SearchController;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' => (app()->environment() == 'testing') ? 'en' : LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/about', [\App\Http\Controllers\AboutController::class, 'index']);
    Route::get('/terms', [\App\Http\Controllers\TermsController::class, 'index']);
    Route::get('/privacy', [\App\Http\Controllers\PrivacyController::class, 'index']);
    AdvancedRoute::controller('contact', \App\Http\Controllers\ContactController::class);
    AdvancedRoute::controller('auth', \App\Http\Controllers\AuthController::class);
    AdvancedRoute::controller('posts', \App\Http\Controllers\PostsController::class);
    Route::group(['middleware' => ['auth']], function () {
        AdvancedRoute::controller('dashboard', \App\Http\Controllers\DashboardController::class);
        AdvancedRoute::controller('profile', \App\Http\Controllers\ProfileController::class);
        AdvancedRoute::controller('notifications', \App\Http\Controllers\NotificationsController::class);
        AdvancedRoute::controller('my-posts', \App\Http\Controllers\MyPostsController::class);
        Route::group(['prefix' => 'admin', 'middleware' => ['IsAdmin']], function () {
            AdvancedRoute::controller('posts', \App\Http\Controllers\Admin\PostsController::class);
        });
    });

});
