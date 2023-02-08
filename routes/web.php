<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\AllUsersController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');



// Profile //
Route::prefix('my-profile')->middleware(['auth', 'verified'])->group(function() {
    Route::get('/', [MyProfileController::class, 'index'])->name('my.profile.index');
    Route::put('/', [MyProfileController::class, 'update'])->name('my.profile.update');
});



// All Users //
Route::get('users', [AllUsersController::class, 'index'])->middleware('auth')->name('users');

Route::delete('/users/{id}', [AllUsersController::class, 'destroy']);