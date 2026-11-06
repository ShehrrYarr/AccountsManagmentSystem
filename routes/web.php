<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\StatementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Guest
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::view('/login', 'ams.auth.login')->name('login');
    Route::view('/forgot-password', 'ams.auth.forgot-password')->name('password.request');
    Route::get('/reset-password/{token}', fn (string $token) => view('ams.auth.reset-password', ['token' => $token]))->name('password.reset');
});

/*
|--------------------------------------------------------------------------
| Application (signed-in, active users)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'active'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Named-route redirect keeps the sub-path (/ams) — Route::redirect('/', '/dashboard')
    // emits a bare "/dashboard" and would leave the app.
    Route::get('/', fn () => redirect()->route('dashboard'))->name('home');
    Route::view('/dashboard', 'ams.dashboard')->name('dashboard');
    Route::view('/profile', 'ams.profile')->name('profile');

    Route::view('/cheques', 'ams.cheques.index')->name('cheques.index');
    Route::view('/disbursements', 'ams.disbursements.index')->name('disbursements.index');
    Route::view('/transfers', 'ams.transfers.index')->name('transfers.index');
    Route::view('/transactions', 'ams.transactions.index')->name('transactions.index');

    Route::view('/companies', 'ams.companies.index')->name('companies.index');
    Route::get('/companies/{company}', fn (\App\Models\Company $company) => view('ams.companies.show', compact('company')))
        ->withTrashed()->name('companies.show');
    Route::get('/companies/{company}/statement.pdf', [StatementController::class, 'pdf'])->withTrashed()->name('companies.statement.pdf');
    Route::get('/companies/{company}/statement/print', [StatementController::class, 'print'])->withTrashed()->name('companies.statement.print');

    Route::view('/bank-accounts', 'ams.bank-accounts.index')->name('bank-accounts.index');
    Route::view('/vendors', 'ams.vendors.index')->name('vendors.index');
    Route::view('/departments', 'ams.departments.index')->name('departments.index');

    // Private uploads (cheque scans, purchase receipts)
    Route::get('/files/{type}/{id}', [FileController::class, 'show'])
        ->whereIn('type', ['cheque', 'disbursement'])->whereNumber('id')->name('files.show');

    Route::middleware('can:admin')->group(function () {
        Route::view('/adjustments', 'ams.adjustments.index')->name('adjustments.index');
        Route::view('/approvals', 'ams.approvals.index')->name('approvals.index');
        Route::view('/users', 'ams.users.index')->name('users.index');
        Route::view('/audit-log', 'ams.audit.index')->name('audit.index');

        // Original Herozi demo pages, kept as a UI reference (hidden from the menu).
        Route::get('/herozi/{page}', [DashboardController::class, 'index'])->where('page', '[A-Za-z0-9\-]+')->name('herozi.demo');
    });
});
