<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\RegistrationFormController;
use App\Http\Controllers\Admin\EventRegistrationController;
use App\Http\Controllers\Admin\RegistrationApprovalController;

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

// Registration Routes
Route::prefix('registrasi')->name('registrasi.')->group(function () {
    Route::get('/', [RegistrationController::class, 'index'])->name('index');
    Route::get('/form/{form}', [RegistrationController::class, 'show'])->name('show');
    Route::post('/form/{form}', [RegistrationController::class, 'store'])->name('store');
    Route::get('/success', [RegistrationController::class, 'success'])->name('success');
    Route::get('/upload_invoice/{token}', [RegistrationController::class, 'upload_invoice'])->name('upload_invoice');
    Route::post('/store_bukti/{token}', [RegistrationController::class, 'store_bukti'])->name('store_bukti');
    Route::get('/success_store', [RegistrationController::class, 'success_store'])->name('success_store');
    Route::get('/status/{token}', [RegistrationController::class, 'check_status'])->name('status');
    Route::get('/{token}/invoice', [RegistrationController::class, 'streamInvoice'])->name('invoice');
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

    // Registration Approval Routes
    Route::prefix('registration-approvals')->name('registration-approvals.')->group(function () {
        Route::get('/', [RegistrationApprovalController::class, 'index'])->name('index');
        Route::get('/{registration}', [RegistrationApprovalController::class, 'show'])->name('show');
        Route::post('/{registration}/approve-data', [RegistrationApprovalController::class, 'approveData'])->name('approve-data');
        Route::post('/{registration}/approve-payment', [RegistrationApprovalController::class, 'approvePayment'])->name('approve-payment');
    });

    // Pastikan route ini ada dan benar
    Route::post('/registrations/{registration}/approve', [App\Http\Controllers\Admin\EventRegistrationController::class, 'approve'])->name('registrations.approve');
    Route::post('/registrations/{registration}/approve-payment', [App\Http\Controllers\Admin\EventRegistrationController::class, 'approvePayment'])->name('registrations.approve-payment');
    Route::post('/registrations/{registration}/reject', [App\Http\Controllers\Admin\EventRegistrationController::class, 'reject'])->name('registrations.reject');
    Route::post('/registrations/{registration}/reject-payment', [App\Http\Controllers\Admin\EventRegistrationController::class, 'rejectPayment'])->name('registrations.reject-payment');

    // Resource route untuk registrations
    Route::resource('registrations', App\Http\Controllers\Admin\EventRegistrationController::class);

    // WhatsApp Management Routes
    Route::prefix('whatsapp')->name('whatsapp.')->group(function () {
        Route::get('/', [App\Http\Controllers\Whatsapp\WhatsappConnectController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Whatsapp\WhatsappConnectController::class, 'create'])->name('create');
        Route::post('/store', [App\Http\Controllers\Whatsapp\WhatsappConnectController::class, 'store'])->name('store');
        Route::delete('/delete', [App\Http\Controllers\Whatsapp\WhatsappConnectController::class, 'delete'])->name('delete');
        Route::post('/test-connection', [App\Http\Controllers\Whatsapp\WhatsappConnectController::class, 'testConnection'])->name('test-connection');
        Route::post('/test-send', [App\Http\Controllers\Whatsapp\WhatsappConnectController::class, 'testSend'])->name('test-send');
        Route::post('/send-custom', [App\Http\Controllers\Whatsapp\WhatsappConnectController::class, 'sendCustomMessage'])->name('send-custom');
        Route::post('/disconnect', [App\Http\Controllers\Whatsapp\WhatsappConnectController::class, 'disconnect'])->name('disconnect');

        // QR Code Routes
        Route::get('/qrcode', [App\Http\Controllers\Whatsapp\WhatsappConnectController::class, 'qrcode'])->name('qrcode');
        Route::post('/store-qr', [App\Http\Controllers\Whatsapp\WhatsappConnectController::class, 'storeQr'])->name('store-qr');
        Route::get('/qr-http', [App\Http\Controllers\Whatsapp\WhatsappConnectController::class, 'getQrCode'])->name('qr-http');
        Route::post('/test-manual-add', [App\Http\Controllers\Whatsapp\WhatsappConnectController::class, 'testManualAdd'])->name('test-manual-add');
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('language/{locale}', [App\Http\Controllers\LanguageController::class, 'changeLanguage'])->name('language.change');
