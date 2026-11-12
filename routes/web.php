<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\StatementController;
use App\Models\Account;
use App\Models\Company;
use App\Models\Department;
use App\Models\Supplier;
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
| Application: signed-in, active administrators and agents
|--------------------------------------------------------------------------
| Agents get only their govt cheques, their own accounts and their profile;
| everything else is for administrators.
*/
Route::middleware(['auth', 'active'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Named-route redirect keeps the sub-path (/ams) — Route::redirect('/', '/dashboard')
    // emits a bare "/dashboard" and would leave the app.
    Route::get('/', fn () => redirect()->route(auth()->user()->isAdmin() ? 'dashboard' : 'cheques.index'))->name('home');
    Route::view('/profile', 'ams.profile')->name('profile');

    // Govt cheques (an agent sees only the cheques they received)
    Route::view('/cheques', 'ams.cheques.index')->name('cheques.index');
    Route::view('/cheques/deposit', 'ams.cheques.create')->name('cheques.create');
    Route::view('/my-accounts', 'ams.my-accounts')->name('my-accounts');

    // Private uploads (cheque scans, receipts); access is checked per file
    Route::get('/files/{type}/{id}', [FileController::class, 'show'])
        ->whereIn('type', ['cheque', 'payment', 'expense', 'cheque-request'])->whereNumber('id')->name('files.show');

    Route::middleware('can:admin')->group(function () {
        Route::view('/dashboard', 'ams.dashboard')->name('dashboard');
        Route::view('/approvals', 'ams.approvals.index')->name('approvals.index');

        // Money out
        Route::view('/payments', 'ams.payments.index')->name('payments.index');
        Route::view('/supplier-payments', 'ams.supplier-payments.index')->name('supplier-payments.index');
        Route::view('/expenses', 'ams.expenses.index')->name('expenses.index');
        Route::view('/transfers', 'ams.transfers.index')->name('transfers.index');

        // Ledgers & statements
        Route::view('/companies', 'ams.companies.index')->name('companies.index');
        Route::get('/companies/{company}', fn (Company $company) => view('ams.companies.show', compact('company')))->withTrashed()->name('companies.show');
        Route::view('/accounts', 'ams.accounts.index')->name('accounts.index');
        Route::get('/accounts/{account}', fn (Account $account) => view('ams.accounts.show', compact('account')))->withTrashed()->name('accounts.show');
        Route::view('/departments', 'ams.departments.index')->name('departments.index');
        Route::get('/departments/{department}', fn (Department $department) => view('ams.departments.show', compact('department')))->name('departments.show');
        Route::view('/suppliers', 'ams.suppliers.index')->name('suppliers.index');
        Route::get('/suppliers/{supplier}', fn (Supplier $supplier) => view('ams.suppliers.show', compact('supplier')))->name('suppliers.show');
        Route::view('/transactions', 'ams.transactions.index')->name('transactions.index');

        Route::get('/statements/{kind}/{id}/print', [StatementController::class, 'print'])
            ->whereIn('kind', ['account', 'department', 'supplier', 'company'])->whereNumber('id')->name('statements.print');
        Route::get('/statements/{kind}/{id}/pdf', [StatementController::class, 'pdf'])
            ->whereIn('kind', ['account', 'department', 'supplier', 'company'])->whereNumber('id')->name('statements.pdf');

        // Setup
        Route::view('/opening-balances', 'ams.opening-balances.index')->name('opening-balances.index');
        Route::view('/expense-categories', 'ams.expense-categories.index')->name('expense-categories.index');
        Route::view('/users', 'ams.users.index')->name('users.index');
        Route::view('/audit-log', 'ams.audit.index')->name('audit.index');

        // Original Herozi demo pages, kept as a UI reference (hidden from the menu).
        Route::get('/herozi/{page}', [DashboardController::class, 'index'])->where('page', '[A-Za-z0-9\-]+')->name('herozi.demo');
    });
});
