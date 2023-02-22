<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\AllUsersController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;




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




// First //
Route::get('/', function () {
    return view('welcome');
})->middleware('guest');


// Home //
Auth::routes(['verify' =>true]);
Route::get('/home', [HomeController::class, 'index'])->middleware('userStatus')->name('home');


// Profile //
Route::prefix('my-profile')->middleware(['auth', 'verified'])->group(function() {
    Route::get('/', [MyProfileController::class, 'index'])->name('my.profile.index');
    Route::put('/', [MyProfileController::class, 'update'])->name('my.profile.update');
});


// All Users //
Route::get('users', [AllUsersController::class, 'index'])->middleware('auth')->name('users');
Route::delete('/users/{id}', [AllUsersController::class, 'destroy']);


// User //
Route::prefix('user')->middleware(['auth', 'verified', 'superAdmin'])->group(function() {
    Route::controller(UserController::class)->group(function () {
        Route::get('/',  'index')->name('user.index');
        Route::get('/list',  'list')->name('user.list');
        Route::get('/{user}', 'edit')->name('user.edit');
        Route::put('/{user}', 'update')->name('user.update');
        Route::delete('/{user}', 'destroy')->name('user.destroy');
    });
});


// Tag //
Route::prefix('tag')->middleware(['auth', 'verified',])->group(function() {
    Route::controller(TagController::class)->group(function () {
        Route::get('/',  'index')->name('tag.index');
        Route::get('/tag',  'list')->name('tag.list');
        Route::get('/create', 'create')->name('tag.create');
        Route::put('/', 'store')->name('tag.input');
        Route::get('/{tag}', 'edit')->name('tag.edit');
        Route::put('/{tag}', 'update')->name('tag.update');
        Route::delete('/{tag}', 'destroy')->name('tag.destroy');
    });
});


// Category //
Route::prefix('category')->middleware(['auth', 'verified',])->group(function() {
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/',  'index')->name('category.index');
        Route::get('/category',  'list')->name('category.list');
        Route::get('/create', 'create')->name('category.create');
        Route::put('/', 'store')->name('category.input');
        Route::get('/{category}', 'edit')->name('category.edit');
        Route::put('/{category}', 'update')->name('category.update');
        Route::delete('/{category}', 'destroy')->name('category.destroy');
    });
});


// Post //
Route::get('/post/checkSlug', [PostController::class, 'checkSlug'])->middleware('auth');
Route::prefix('post')->middleware(['auth', 'verified',])->group(function() {
    Route::controller(PostController::class)->group(function () {
        Route::get('/',  'index')->name('post.index');
        Route::get('/post',  'list')->name('post.list');
        Route::get('/create', 'create')->name('post.create');
        Route::put('/', 'store')->name('post.input');
        Route::get('/{post}', 'edit')->name('post.edit');
        Route::put('/{post}', 'update')->name('post.update');
        Route::delete('/{post}', 'destroy')->name('post.destroy');
    });
});