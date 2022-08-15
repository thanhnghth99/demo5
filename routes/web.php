<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use Monolog\Processor\HostnameProcessor;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;


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

// Route::get('/home', [HomeController::class, 'redirect']);
// Route::get('/categories', [CategoriesController::class, 'redirect']);
// Route::get('/categories', [CategoriesController::class, 'redirect']);
// Route::get('/categories', [CategoriesController::class, 'redirect']);

Route::resource('home', HomeController::class);
Route::resource('permission', PermissionController::class);
Route::resource('role', RoleController::class);
Route::resource('user', UserController::class);
Route::resource('category', CategoryController::class);
Route::resource('article', ArticleController::class);
Route::resource('tag', TagController::class);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});