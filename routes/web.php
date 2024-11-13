<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    HomeController,
    AlbumController,
    PhotoController,
    ProfileController,
};

Route::get('/', function () {
    return redirect()->route('home');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('auth/login', 'showLoginForm')->name('login')->middleware('guest');
    Route::post('auth/login', 'postLogin')->name('postLogin');
    Route::post('logout', 'logout')->name('logout');
    Route::get('auth/register', 'showRegistrationForm')->name('register.form');
    Route::post('auth/register', 'register')->name('register');
});

Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('photos/search', [PhotoController::class, 'search'])->name('photos.search');

Route::resource('albums', AlbumController::class);
Route::get('/albums/{album}/photos', [PhotoController::class, 'index'])->name('albums.photos');

Route::middleware('auth')->group(function () {
    Route::resource('photos', PhotoController::class);

    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
});