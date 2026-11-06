<?php

namespace App\Providers;

use App\Models\BankAccount;
use App\Models\Cheque;
use App\Models\Company;
use App\Models\CompanyAdjustment;
use App\Models\CompanyBankAccount;
use App\Models\Disbursement;
use App\Models\GovernmentDepartment;
use App\Models\InternalTransfer;
use App\Models\User;
use App\Models\Vendor;
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
            'company_bank_account' => CompanyBankAccount::class,
            'bank_account' => BankAccount::class,
            'government_department' => GovernmentDepartment::class,
            'vendor' => Vendor::class,
            'cheque' => Cheque::class,
            'disbursement' => Disbursement::class,
            'internal_transfer' => InternalTransfer::class,
            'company_adjustment' => CompanyAdjustment::class,
        ]);

        Paginator::useBootstrapFive();

        Gate::define('admin', fn (User $user) => $user->isAdmin());
    }
}
