<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\Cheque;
use App\Models\Company;
use App\Models\DealClosing;
use App\Models\Department;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\OpeningBalance;
use App\Models\Payment;
use App\Models\Supplier;
use App\Models\SupplierPayment;
use App\Models\Transfer;
use App\Models\User;
use App\Services\LedgerService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Keeps batch depth / touched-balance state for one request.
        $this->app->singleton(LedgerService::class);
    }

    public function boot(): void
    {
        Model::preventSilentlyDiscardingAttributes(! $this->app->isProduction());

        // Short, stable names in polymorphic columns (transactions.source_type, audit logs...).
        Relation::enforceMorphMap([
            'user' => User::class,
            'company' => Company::class,
            'account' => Account::class,
            'department' => Department::class,
            'supplier' => Supplier::class,
            'expense_category' => ExpenseCategory::class,
            'cheque' => Cheque::class,
            'payment' => Payment::class,
            'supplier_payment' => SupplierPayment::class,
            'transfer' => Transfer::class,
            'expense' => Expense::class,
            'deal_closing' => DealClosing::class,
            'opening_balance' => OpeningBalance::class,
        ]);

        Paginator::useBootstrapFive();

        Gate::define('admin', fn (User $user) => $user->isAdmin());

        // Re-apply "active user" checks on every Livewire update request, not just page loads.
        \Livewire\Livewire::addPersistentMiddleware([\App\Http\Middleware\EnsureUserIsActive::class]);
    }
}
