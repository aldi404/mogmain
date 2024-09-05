<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('/')->name('user::')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/services', [UserController::class, 'services'])->name('services');
    Route::get('/news', [UserController::class, 'news'])->name('news');
    Route::get('/clients', [UserController::class, 'clients'])->name('clients');
    Route::get('/meet-the-teams', [UserController::class, 'meet_the_teams'])->name('meet_the_teams');
    Route::get('/contact', [UserController::class, 'contact'])->name('contact');

    Route::prefix('/events')->name('events::')->group(function () {
        Route::get('/', [UserController::class, 'index_events'])->name('index_events');

        Route::get('/detail/{slug}', [UserController::class, 'detail_events'])->name('detail_events');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
