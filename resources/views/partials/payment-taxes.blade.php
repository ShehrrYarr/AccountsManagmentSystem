{{--
    The "Taxes" rows of a bank payment (Pay Department / Pay Supplier). Uses HasTaxFields.
    @include('partials.payment-taxes', ['taxes' => $taxes, 'taxOptions' => $this->taxOptions(), 'label' => $label,
        'addingTax' => $addingTax, 'canAddTax' => true, 'amount' => $amount])
--}}
@php($taxTotal = \App\Support\Money::add('0', ...array_map(fn ($t) => is_numeric($t['amount'] ?? null) ? $t['amount'] : 0, $taxes)))
<div class="col-12">
    <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
        <span class="{{ $label }} mb-0">Taxes</span>
        <span class="fs-11 text-muted">paid from the same bank, on top of the amount (the company's cost)</span>
        @if ($canAddTax)
            <a href="#" class="fs-11 ms-auto" wire:click.prevent="$toggle('addingTax')">{{ $addingTax ? 'Cancel' : '+ New tax' }}</a>
        @endif
    </div>
    @if ($addingTax)
        <div class="input-group input-group-sm has-validation mb-2" style="max-width: 28rem">
            <input type="text" class="form-control @error('newTax') is-invalid @enderror" wire:model="newTax" placeholder="Tax name, e.g. Withholding tax" wire:keydown.enter.prevent="addTax">
            <button type="button" class="btn btn-primary" wire:click="addTax">Add</button>
            @error('newTax') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    @endif
    @foreach ($taxes as $ti => $t)
        <div class="row g-2 mb-1 align-items-start" wire:key="tax-row-{{ $ti }}">
            <div class="col-sm-6 col-lg-4">
                <x-searchable-select wire:model.live="taxes.{{ $ti }}.tax_id" :options="$taxOptions" placeholder="Select tax" size="sm" :invalid="$errors->has('taxes.'.$ti.'.tax_id')" />
                @error('taxes.'.$ti.'.tax_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>
            <div class="col-9 col-sm-4 col-lg-3">
                <div class="input-group input-group-sm has-validation">
                    <span class="input-group-text">Rs.</span>
                    <input type="number" step="0.01" min="0" class="form-control @error('taxes.'.$ti.'.amount') is-invalid @enderror" wire:model.live.debounce.400ms="taxes.{{ $ti }}.amount" placeholder="Tax amount">
                    @error('taxes.'.$ti.'.amount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-sm btn-light text-danger" wire:click="removeTaxRow({{ $ti }})" title="Remove this tax"><i class="ri-close-line"></i></button>
            </div>
        </div>
    @endforeach
    @error('taxes') <div class="text-danger fs-12">{{ $message }}</div> @enderror
    <div class="d-flex flex-wrap gap-3 align-items-center fs-12">
        <a href="#" wire:click.prevent="addTaxRow"><i class="ri-add-line"></i> Add tax</a>
        @if (\App\Support\Money::isPositive($taxTotal))
            <span class="text-muted ams-balance">Out of the bank: {{ money(is_numeric($amount) ? $amount : 0) }} + taxes {{ money($taxTotal) }} =
                <strong class="text-body">{{ money(\App\Support\Money::add(is_numeric($amount) ? $amount : 0, $taxTotal)) }}</strong></span>
        @endif
    </div>
</div>
