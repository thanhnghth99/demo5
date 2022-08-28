<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use Monolog\Processor\HostnameProcessor;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Public\HomeController;

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
    return view('welcome');
});

Route::controller(HomeController::class)
    ->name('public.')
    ->group(function () {
        Route::get('/home', 'index')->name('home');
        Route::get('/category-list/{id}', 'category')->name('category');
        Route::get('/tag-list/{id}', 'tag')->name('tag');
        Route::get('/article-list/{id}', 'single')->name('article');
        Route::get('/contact', 'contact')->name('contact');
        Route::get('/search', 'search')->name('search');
    });

Route::middleware(['auth'])->group(function () {
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);
    Route::resource('user', UserController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('article', ArticleController::class);
    Route::resource('tag', TagController::class);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
