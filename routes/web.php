<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\PostController as ControllersPostController;
use App\Http\Controllers\SearchController;
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

route::get('/' , function(){
    return view('welcome');
});

Route::resource('the_posts', ControllersPostController::class);

route::get('/search', [SearchController::class, 'index'])->name('search');

Auth::routes();

Route::group(['middleware' => 'auth'], function (){


    Route::get('/the_dashboard', [DashboardController::class, 'index'])->name('the_dashboard');

    // Categories & Subcategories
    Route::resource('categories', CategoryController::class);
    Route::get('categories/{category}/delete', [CategoryController::class, 'destroy'])->name('categories.delete');

    // Posts
    Route::resource('posts', PostController::class);
    Route::get('posts/{post}/delete', [PostController::class, 'destroy'])->name('posts.delete');

    // Users
    Route::resource('users', UserController::class);
    Route::get('users/{user}/delete', [UserController::class, 'destroy'])->name('users.delete');

});

