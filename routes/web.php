<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\RegistrationFormController;
use App\Http\Controllers\Admin\EventRegistrationController;

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

// User Routes
Route::group(['prefix' => '', 'as' => 'user::'], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/services', [UserController::class, 'services'])->name('services');
    Route::get('/events', [UserController::class, 'index_events'])->name('events::index_events');
    Route::get('/news', [UserController::class, 'news'])->name('news');
    Route::get('/meet-the-teams', [UserController::class, 'meet_the_teams'])->name('meet_the_teams');
    Route::get('/contact', [UserController::class, 'contact'])->name('contact');
    Route::get('/careers', [UserController::class, 'careers'])->name('career');
    Route::get('/hugocray', [UserController::class, 'hugocray'])->name('hugocray');
    Route::get('/about', [UserController::class, 'about'])->name('about');
    Route::get('/products', [UserController::class, 'products'])->name('products');
    Route::get('/partnerships', [UserController::class, 'partnerships'])->name('partnerships');

    // Additional routes if needed
    Route::post('/contact', [UserController::class, 'contactSubmit'])->name('contact::submit');
});

// Registration Routes (Public)
Route::group(['prefix' => 'registrasi', 'as' => 'registrasi.'], function () {
    Route::get('/', [RegistrationController::class, 'index'])->name('index');
    Route::get('/form/{form}', [RegistrationController::class, 'show'])->name('show');
    Route::post('/form/{form}', [RegistrationController::class, 'store'])->name('store');
    Route::get('/success', [RegistrationController::class, 'success'])->name('success');
    Route::get('/upload_invoice/{id}', [RegistrationController::class, 'upload_invoice'])->name('upload_invoice');
    Route::post('/store_bukti/{id}', [RegistrationController::class, 'store_bukti'])->name('store_bukti');
    Route::get('/success_store', [RegistrationController::class, 'success_store'])->name('success_store');
});

// Admin Authentication Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

// Admin Protected Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin']], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Events Management
    Route::resource('events', EventController::class);

    // Registration Forms Management
    Route::resource('registration-forms', RegistrationFormController::class);
    Route::patch('registration-forms/{registrationForm}/toggle-status', [RegistrationFormController::class, 'toggleStatus'])->name('registration-forms.toggle-status');

    // Event Registrations Management
    Route::get('registrations', [EventRegistrationController::class, 'index'])->name('registrations.index');
    Route::get('registrations/{registration}', [EventRegistrationController::class, 'show'])->name('registrations.show');
    Route::patch('registrations/{registration}/status', [EventRegistrationController::class, 'updateStatus'])->name('registrations.update-status');
    Route::delete('registrations/{registration}', [EventRegistrationController::class, 'destroy'])->name('registrations.destroy');
    Route::get('registrations/export/csv', [EventRegistrationController::class, 'export'])->name('registrations.export');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('language/{locale}', [App\Http\Controllers\LanguageController::class, 'changeLanguage'])->name('language.change');
