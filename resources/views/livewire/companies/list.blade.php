<?php

/**
 * My companies: where each one's money is (its banks; what it has moved into the admin's cash in
 * hand, which belongs to no company), cheques this month and what is owed, plus a create / edit modal.
 */

use App\Enums\AccountType;
use App\Livewire\Concerns\InteractsWithUi;
use App\Models\Account;
use App\Models\Cheque;
use App\Models\Company;
use App\Services\Balances;
use App\Services\MasterDataService;
use App\Support\Money;
use Illuminate\Validation\Rule;

use function Livewire\Volt\{computed, on, rules, state, uses};

uses([InteractsWithUi::class]);

state(['companyId' => null])->locked();
state(['showInactive' => false]);
state([
    'name' => '', 'ntn' => '', 'registration_no' => '', 'phone' => '', 'email' => '', 'address' => '', 'notes' => '',
    'is_active' => true, 'cash_opening' => '0', 'opening_date' => '',
]);

rules(fn () => [
    'name' => ['required', 'string', 'max:255', Rule::unique('companies', 'name')->ignore($this->companyId)],
    'ntn' => ['nullable', 'string', 'max:50'],
    'registration_no' => ['nullable', 'string', 'max:100'],
    'phone' => ['nullable', 'string', 'max:30'],
    'email' => ['nullable', 'email', 'max:255'],
    'address' => ['nullable', 'string', 'max:1000'],
    'notes' => ['nullable', 'string', 'max:2000'],
    'is_active' => ['boolean'],
    'cash_opening' => ['nullable', 'numeric', 'min:0'],
    'opening_date' => ['nullable', 'date'],
]);

$rows = computed(function () {
    $companies = Company::query()->when(! $this->showInactive, fn ($q) => $q->where('is_active', true))->orderBy('name')->get();

    $banks = Account::query()->banks()->whereNotNull('company_id')->selectRaw('company_id, SUM(current_balance) as total')->groupBy('company_id')->pluck('total', 'company_id');
    $cash = Balances::movedToCash();
    $cheques = Cheque::whereBetween('date', [now()->startOfMonth()->toDateString(), now()->toDateString()])->selectRaw('company_id, SUM(amount) as total, COUNT(*) as n')->groupBy('company_id')->get()->keyBy('company_id');
    $depts = Balances::departments()->groupBy('company_id');
    $suppliers = Balances::suppliers()->groupBy('company_id');

    return $companies->map(function (Company $c) use ($banks, $cash, $cheques, $depts, $suppliers) {
        $d = $depts->get($c->id, collect());

        return (object) [
            'company' => $c,
            'cash' => Money::of($cash[$c->id] ?? 0),
            'bank' => Money::of($banks[$c->id] ?? 0),
            'chequesAmount' => Money::of($cheques[$c->id]->total ?? 0),
            'chequesCount' => (int) ($cheques[$c->id]->n ?? 0),
            'deptsOwe' => Money::add(...$d->filter(fn ($r) => Money::isPositive($r->balance))->pluck('balance')->all()),
            'deptsHeld' => Money::sub(0, Money::add(...$d->filter(fn ($r) => Money::isNegative($r->balance))->pluck('balance')->all())),
            'suppliersOwed' => Money::add(...$suppliers->get($c->id, collect())->pluck('owed')->all()),
        ];
    });
});

on(['transaction-updated' => function () {
    unset($this->rows);
}]);

$create = function () {
    $this->resetErrorBag();
    $this->companyId = null;
    $this->fill(['name' => '', 'ntn' => '', 'registration_no' => '', 'phone' => '', 'email' => '', 'address' => '', 'notes' => '',
        'is_active' => true, 'cash_opening' => '0', 'opening_date' => now()->toDateString()]);
    $this->showModal('companyModal');
};

$edit = function (int $id) {
    $this->resetErrorBag();
    $c = Company::findOrFail($id);
    $this->companyId = $c->id;
    $this->fill($c->only(['name', 'ntn', 'registration_no', 'phone', 'email', 'address', 'notes', 'is_active']));
    $this->showModal('companyModal');
};

$save = function () {
    $data = $this->validate();
    if ($this->companyId) {
        unset($data['cash_opening'], $data['opening_date']); // edited on the Cash & Bank page
    }
    $ok = $this->attempt(function () use ($data) {
        $saved = app(MasterDataService::class)->saveCompany($this->companyId ? Company::findOrFail($this->companyId) : null, $data);
        $this->toast('success', $this->companyId ? "{$saved->name} saved." : "{$saved->name} created. Add its bank accounts next.");
    });
    if ($ok !== false) {
        $this->hideModal('companyModal');
        $this->broadcastChange();
    }
};

$delete = function (int $id) {
    if ($this->attempt(fn () => app(MasterDataService::class)->deleteCompany(Company::findOrFail($id))) !== false) {
        $this->toast('success', 'Company deleted.');
        $this->broadcastChange();
    }
};

?>

<div>
    <div class="card">
        <div class="card-header d-flex flex-wrap gap-2 align-items-center">
            <h5 class="card-title mb-0 me-auto">My companies</h5>
            <div class="form-check form-switch mb-0">
                <input class="form-check-input" type="checkbox" id="co-inactive" wire:model.live="showInactive">
                <label class="form-check-label fs-13" for="co-inactive">Show inactive</label>
            </div>
            <button type="button" class="btn btn-sm btn-primary" wire:click="create"><i class="ri-add-line me-1"></i>New company</button>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 ams-table">
                    <thead class="table-light">
                        <tr>
                            <th>Company</th>
                            <th class="money d-none d-md-table-cell" title="Moved from this company's banks into the admin cash in hand, less cash deposited back">Moved to cash</th>
                            <th class="money d-none d-md-table-cell">Bank</th>
                            <th class="money d-none d-lg-table-cell">Cheques this month</th>
                            <th class="money d-none d-lg-table-cell" title="Departments that owe this company (spent more than cheques received)">Depts owe</th>
                            <th class="money d-none d-lg-table-cell" title="Cheques received ahead of spending">Held for depts</th>
                            <th class="money d-none d-xl-table-cell">Owed to suppliers</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($this->rows as $r)
                            <tr wire:key="co-{{ $r->company->id }}">
                                <td>
                                    <a href="{{ route('companies.show', $r->company) }}" class="fw-semibold text-body">{{ $r->company->name }}</a>
                                    @unless ($r->company->is_active)<span class="badge bg-secondary-subtle text-secondary ms-1">Inactive</span>@endunless
                                    @if ($r->company->ntn)<div class="fs-12 text-muted">NTN {{ $r->company->ntn }}</div>@endif
                                    <div class="d-md-none fs-12 mt-1">
                                        Bank <strong>{{ money($r->bank) }}</strong> · Moved to cash <strong>{{ money($r->cash) }}</strong>
                                        @if ($r->chequesCount)<br>Cheques this month {{ money($r->chequesAmount) }}@endif
                                    </div>
                                </td>
                                <td class="money d-none d-md-table-cell">{{ money($r->cash) }}</td>
                                <td class="money d-none d-md-table-cell">{{ money($r->bank) }}</td>
                                <td class="money d-none d-lg-table-cell">{{ money($r->chequesAmount) }}@if ($r->chequesCount)<div class="fs-11 text-muted">{{ $r->chequesCount }} cheque(s)</div>@endif</td>
                                <td class="money d-none d-lg-table-cell {{ Money::isPositive($r->deptsOwe) ? 'text-danger' : 'text-muted' }}">{{ money($r->deptsOwe) }}</td>
                                <td class="money d-none d-lg-table-cell {{ Money::isPositive($r->deptsHeld) ? 'text-success' : 'text-muted' }}">{{ money($r->deptsHeld) }}</td>
                                <td class="money d-none d-xl-table-cell {{ Money::isPositive($r->suppliersOwed) ? 'text-warning' : 'text-muted' }}">{{ money($r->suppliersOwed) }}</td>
                                <td class="text-end text-nowrap">
                                    <a href="{{ route('companies.show', $r->company) }}" class="btn btn-sm btn-light" title="Open ledger"><i class="ri-book-open-line"></i><span class="d-none d-xl-inline ms-1">Ledger</span></a>
                                    <button type="button" class="btn btn-sm btn-light icon-btn-sm" title="Edit" wire:click="edit({{ $r->company->id }})"><i class="ri-edit-line"></i></button>
                                    <button type="button" class="btn btn-sm btn-light-danger icon-btn-sm" title="Delete"
                                        x-on:click="amsConfirm(@js('Delete '.$r->company->name.'? Only possible when it has no transactions.'), 'Delete').then(ok => ok && $wire.delete({{ $r->company->id }}))"><i class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                        @empty
                            <x-empty-row :colspan="8" icon="ri-building-2-line" message="No companies yet — add your first company." />
                        @endforelse
                    </tbody>
                    @if ($this->rows->count() > 1)
                        <tfoot class="table-light fw-semibold fs-13">
                            <tr>
                                <td>Total</td>
                                <td class="money d-none d-md-table-cell">{{ money(Money::add(...$this->rows->pluck('cash')->all())) }}</td>
                                <td class="money d-none d-md-table-cell">{{ money(Money::add(...$this->rows->pluck('bank')->all())) }}</td>
                                <td class="money d-none d-lg-table-cell">{{ money(Money::add(...$this->rows->pluck('chequesAmount')->all())) }}</td>
                                <td class="money d-none d-lg-table-cell">{{ money(Money::add(...$this->rows->pluck('deptsOwe')->all())) }}</td>
                                <td class="money d-none d-lg-table-cell">{{ money(Money::add(...$this->rows->pluck('deptsHeld')->all())) }}</td>
                                <td class="money d-none d-xl-table-cell">{{ money(Money::add(...$this->rows->pluck('suppliersOwed')->all())) }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>

    <x-modal id="companyModal" :title="$companyId ? 'Edit Company' : 'New Company'" icon="ri-building-2-line" size="lg">
        <form wire:submit="save">
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Company name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">NTN</label>
                        <input type="text" class="form-control" wire:model="ntn">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Registration no.</label>
                        <input type="text" class="form-control" wire:model="registration_no">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" wire:model="phone">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" wire:model="address">
                    </div>
                    @unless ($companyId)
                        <div class="col-12"><div class="form-text mt-0"><i class="ri-information-line"></i> Companies have bank accounts only (add them on the Cash &amp; Bank page); cash is the admin's cash in hand.</div></div>
                    @endunless
                    <div class="col-12">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control" rows="2" wire:model="notes"></textarea>
                    </div>
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="co-active" wire:model="is_active">
                            <label class="form-check-label" for="co-active">Active (shown in dropdowns)</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save"><i class="ri-save-3-line me-1"></i>Save</button>
            </div>
        </form>
    </x-modal>
</div>
