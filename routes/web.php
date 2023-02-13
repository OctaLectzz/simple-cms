<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AllUsersController;
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



// Datatable //
Route::prefix('user')->middleware(['auth', 'verified', 'superAdmin'])->group(function() {
    Route::controller(UserController::class)->group(function () {
        Route::get('/list',  'list')->name('user.list');
        Route::get('/{user}', 'edit')->name('user.edit');
        Route::put('/{user}', 'update')->name('user.update');
        Route::get('/',  'index')->name('user.index');
        Route::delete('/{user}', 'destroy')->name('user.destroy');
    });
});