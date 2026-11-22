<?php

use App\Http\Controllers\Api\V1;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Mobile app API, version 1   →   http://<host>/ams/api/v1/...
|--------------------------------------------------------------------------
| Sign in with POST auth/login, then send "Authorization: Bearer <token>" on every request.
| Writes may carry an "Idempotency-Key" header so a replayed offline entry is saved once.
| Reference: docs/API.md. Admin-only endpoints answer 403 to agents.
*/
Route::prefix('v1')->name('api.')->group(function () {
    Route::post('auth/login', [V1\AuthController::class, 'login'])->middleware('throttle:10,1')->name('login');

    Route::middleware(['auth:sanctum', 'api.active', 'throttle:240,1', 'idempotent'])->group(function () {
        // Signed-in user and devices
        Route::get('auth/me', [V1\AuthController::class, 'me']);
        Route::post('auth/logout', [V1\AuthController::class, 'logout']);
        Route::get('auth/devices', [V1\AuthController::class, 'devices']);
        Route::delete('auth/devices/{device}', [V1\AuthController::class, 'revokeDevice'])->whereNumber('device');

        // Pickers (cache on the phone), home screen, bell
        Route::get('lookups', [V1\LookupController::class, 'index']);
        Route::get('dashboard', [V1\DashboardController::class, 'show']);
        Route::get('notifications', [V1\DashboardController::class, 'notifications']);

        // Govt cheques (agents: their own; edits / deletes become requests)
        Route::get('cheques', [V1\ChequeController::class, 'index']);
        Route::post('cheques', [V1\ChequeController::class, 'store']);
        Route::post('cheques/batch', [V1\ChequeController::class, 'batch']);
        Route::get('cheques/{cheque}', [V1\ChequeController::class, 'show'])->whereNumber('cheque');
        Route::match(['put', 'patch', 'post'], 'cheques/{cheque}', [V1\ChequeController::class, 'update'])->whereNumber('cheque');
        Route::delete('cheques/{cheque}', [V1\ChequeController::class, 'destroy'])->whereNumber('cheque');
        Route::delete('cheque-requests/{changeRequest}', [V1\ChequeController::class, 'withdrawRequest'])->whereNumber('changeRequest');

        // Department payments (agents: bank transfers from their own bank)
        Route::get('payments', [V1\PaymentController::class, 'index']);
        Route::post('payments', [V1\PaymentController::class, 'store']);
        Route::post('payments/batch', [V1\PaymentController::class, 'batch']);
        Route::get('payments/{payment}', [V1\PaymentController::class, 'show'])->whereNumber('payment');
        Route::match(['put', 'patch', 'post'], 'payments/{payment}', [V1\PaymentController::class, 'update'])->whereNumber('payment');
        Route::delete('payments/{payment}', [V1\PaymentController::class, 'destroy'])->whereNumber('payment');
        Route::delete('payment-requests/{changeRequest}', [V1\PaymentController::class, 'withdrawRequest'])->whereNumber('changeRequest');

        // Transfers, advances, returns
        Route::get('transfers', [V1\TransferController::class, 'index']);
        Route::post('transfers', [V1\TransferController::class, 'store']);
        Route::post('transfers/returns', [V1\TransferController::class, 'storeReturn']);
        Route::get('transfers/{transfer}', [V1\TransferController::class, 'show'])->whereNumber('transfer');
        Route::match(['put', 'patch'], 'transfers/{transfer}', [V1\TransferController::class, 'update'])->whereNumber('transfer');
        Route::delete('transfers/{transfer}', [V1\TransferController::class, 'destroy'])->whereNumber('transfer');

        // Approvals (admin)
        Route::get('approvals', [V1\ApprovalController::class, 'index']);
        Route::post('approvals/{kind}/{id}/approve', [V1\ApprovalController::class, 'approve'])->whereIn('kind', ['cheque-requests', 'payment-requests', 'returns'])->whereNumber('id');
        Route::post('approvals/{kind}/{id}/reject', [V1\ApprovalController::class, 'reject'])->whereIn('kind', ['cheque-requests', 'payment-requests', 'returns'])->whereNumber('id');

        // Money out (admin)
        Route::get('supplier-payments', [V1\MoneyOutController::class, 'supplierPayments']);
        Route::post('supplier-payments', [V1\MoneyOutController::class, 'storeSupplierPayment']);
        Route::get('supplier-payments/{id}', [V1\MoneyOutController::class, 'showSupplierPayment'])->whereNumber('id');
        Route::match(['put', 'patch', 'post'], 'supplier-payments/{id}', [V1\MoneyOutController::class, 'updateSupplierPayment'])->whereNumber('id');
        Route::delete('supplier-payments/{id}', [V1\MoneyOutController::class, 'destroySupplierPayment'])->whereNumber('id');
        Route::get('expenses', [V1\MoneyOutController::class, 'expenses']);
        Route::post('expenses', [V1\MoneyOutController::class, 'storeExpense']);
        Route::get('expenses/{id}', [V1\MoneyOutController::class, 'showExpense'])->whereNumber('id');
        Route::match(['put', 'patch', 'post'], 'expenses/{id}', [V1\MoneyOutController::class, 'updateExpense'])->whereNumber('id');
        Route::delete('expenses/{id}', [V1\MoneyOutController::class, 'destroyExpense'])->whereNumber('id');

        // Companies (admin), accounts (admin: all; agent: own), agents
        Route::apiResource('companies', V1\CompanyController::class)->whereNumber('company');
        Route::apiResource('accounts', V1\AccountController::class)->whereNumber('account');
        Route::get('agents', [V1\AgentController::class, 'index']);
        Route::get('agents/{agent}', [V1\AgentController::class, 'show'])->whereNumber('agent');

        // Departments, suppliers, expense categories (admin)
        Route::get('{kind}', [V1\DirectoryController::class, 'index'])->whereIn('kind', ['departments', 'suppliers', 'expense-categories', 'taxes']);
        Route::post('{kind}', [V1\DirectoryController::class, 'store'])->whereIn('kind', ['departments', 'suppliers', 'expense-categories', 'taxes']);
        Route::get('{kind}/{id}', [V1\DirectoryController::class, 'show'])->whereIn('kind', ['departments', 'suppliers', 'expense-categories', 'taxes'])->whereNumber('id');
        Route::match(['put', 'patch'], '{kind}/{id}', [V1\DirectoryController::class, 'update'])->whereIn('kind', ['departments', 'suppliers', 'expense-categories', 'taxes'])->whereNumber('id');
        Route::delete('{kind}/{id}', [V1\DirectoryController::class, 'destroy'])->whereIn('kind', ['departments', 'suppliers', 'expense-categories', 'taxes'])->whereNumber('id');

        // Opening balances and deal closings (admin)
        Route::get('opening-balances', [V1\BooksController::class, 'openings']);
        Route::post('opening-balances', [V1\BooksController::class, 'storeOpening']);
        Route::match(['put', 'patch'], 'opening-balances/{id}', [V1\BooksController::class, 'updateOpening'])->whereNumber('id');
        Route::delete('opening-balances/{id}', [V1\BooksController::class, 'destroyOpening'])->whereNumber('id');
        Route::get('deal-closings', [V1\BooksController::class, 'closings']);
        Route::post('deal-closings', [V1\BooksController::class, 'storeClosing']);
        Route::match(['put', 'patch'], 'deal-closings/{id}', [V1\BooksController::class, 'updateClosing'])->whereNumber('id');
        Route::delete('deal-closings/{id}', [V1\BooksController::class, 'destroyClosing'])->whereNumber('id');

        // Users & devices (admin)
        Route::get('users', [V1\UserController::class, 'index']);
        Route::post('users', [V1\UserController::class, 'store']);
        Route::get('users/{user}', [V1\UserController::class, 'show'])->whereNumber('user');
        Route::match(['put', 'patch'], 'users/{user}', [V1\UserController::class, 'update'])->whereNumber('user');
        Route::get('users/{user}/devices', [V1\UserController::class, 'devices'])->whereNumber('user');
        Route::delete('users/{user}/devices/{device}', [V1\UserController::class, 'revokeDevice'])->whereNumber(['user', 'device']);

        // Reports
        Route::get('statements/{kind}/{id}', [V1\ReportController::class, 'statement'])->whereIn('kind', \App\Services\StatementService::KINDS)->whereNumber('id');
        Route::get('statements/{kind}/{id}/pdf', [V1\ReportController::class, 'statementPdf'])->whereIn('kind', \App\Services\StatementService::KINDS)->whereNumber('id')->name('statements.pdf');
        Route::get('transactions', [V1\ReportController::class, 'transactions']);
        Route::get('transactions/{id}', [V1\ReportController::class, 'transaction'])->whereNumber('id');
        Route::get('audit-log', [V1\ReportController::class, 'auditLog']);

        // Pictures and receipts (same access rules as the website)
        Route::get('files/{type}/{id}', [FileController::class, 'show'])
            ->whereIn('type', ['cheque', 'payment', 'expense', 'supplier-payment', 'cheque-request', 'payment-request'])->whereNumber('id')->name('files.show');
    });
});
