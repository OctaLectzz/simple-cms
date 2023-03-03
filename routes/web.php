<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AllUsersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MyProfileController;




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




// -----Welcome----- //


// Home //
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/posts/{post:slug}', [WelcomeController::class, 'show'])->name('post.show');

Route::middleware('auth', 'verified', 'userStatus')->group(function() {

    // Profile //
    Route::get('/profile', function () {
        $user = auth()->user();
        return view('profile', compact('user'));
    })->name('profile');
    Route::put('/profile', [WelcomeController::class, 'update'])->name('profile.update');
    Route::put('/profile/{id}', [WelcomeController::class, 'update'])->name('users.update');

    // Comment //
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/posts/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

});

// -----Welcome----- //




// -----Dashboard----- //

Auth::routes(['verify' =>true]);
Route::prefix('dashboard')->middleware(['auth', 'verified', 'Admin', 'userStatus'])->group(function() {

    // Home //
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Edit Profile //
    Route::prefix('my-profile')->group(function() {
        Route::get('/', [MyProfileController::class, 'index'])->name('my.profile.index');
        Route::put('/', [MyProfileController::class, 'update'])->name('my.profile.update');
    });

    // Old Table Users //
    Route::get('users', [AllUsersController::class, 'index'])->middleware('superAdmin')->name('users');
    Route::delete('/users/{user}', [AllUsersController::class, 'destroy'])->name('users.destroy');

    // User //
    Route::prefix('user')->middleware('superAdmin')->group(function() {
        Route::controller(UserController::class)->group(function () {
            Route::get('/',  'index')->name('user.index');
            Route::get('/list',  'list')->name('user.list');
            Route::get('/create', 'create')->name('user.create');
            Route::put('/', 'store')->name('user.input');
            Route::get('/{user}', 'edit')->name('user.edit');
            Route::put('/{user}', 'update')->name('user.update');
            Route::delete('/{user}', 'destroy')->name('user.destroy');
        });
    });

    // Tag //
    Route::prefix('tag')->group(function() {
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
    Route::prefix('category')->group(function() {
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
    Route::get('/post/checkSlug', [PostController::class, 'checkSlug']);
    Route::prefix('post')->group(function() {
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

});

// -----Dashboard----- //




Route::post('/dark-mode', function(Request $request) {
    session(['dark-mode' => $request->input('darkMode')]);
    return response()->json(['status' => 'success']);
});
