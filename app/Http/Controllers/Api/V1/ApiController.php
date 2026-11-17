<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\Balances;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

/**
 * Shared helpers for the mobile API (v1). Business rules live in the services; controllers only
 * validate input, check who may do what, call a service and shape the JSON.
 */
abstract class ApiController extends Controller
{
    protected function requireAdmin(Request $request): void
    {
        abort_unless($request->user()?->isAdmin(), 403, 'Only the admin can do this.');
    }

    protected function isAdmin(Request $request): bool
    {
        return (bool) $request->user()?->isAdmin();
    }

    /** ?per_page= (1–100, default 25). */
    protected function perPage(Request $request): int
    {
        return min(max((int) $request->query('per_page', 25), 1), 100);
    }

    /** ?from= / ?to= on a date column. */
    protected function dateRange(Builder $q, Request $request, string $column = 'date'): Builder
    {
        return $q->when($request->date('from'), fn ($q, $d) => $q->whereDate($column, '>=', $d->toDateString()))
            ->when($request->date('to'), fn ($q, $d) => $q->whereDate($column, '<=', $d->toDateString()));
    }

    /** ?company_id=5, or ?company_id=none for what the cash in hand paid (no company). */
    protected function companyFilter(Builder $q, Request $request, string $column = 'company_id'): Builder
    {
        $value = $request->query('company_id');

        return match (true) {
            $value === null || $value === '' => $q,
            $value === 'none' || $value === '0' => $q->whereNull($column),
            default => $q->where($column, (int) $value),
        };
    }

    /** The company id a balance query takes: null = all, Balances::NONE = no company. */
    protected function balanceCompany(Request $request): ?int
    {
        $value = $request->query('company_id');

        return match (true) {
            $value === null || $value === '' => null,
            $value === 'none' || $value === '0' => Balances::NONE,
            default => (int) $value,
        };
    }

    /** Store an uploaded picture / PDF privately; null when none was sent. */
    protected function storeUpload(?UploadedFile $file, string $folder): ?string
    {
        return $file?->store($folder.'/'.now()->format('Y/m'), 'local');
    }

    /** Validation rule for an uploaded picture or PDF. */
    protected function fileRule(): array
    {
        return ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'];
    }
}
