@extends('layouts.app')

@section('title', $supplier->name)
@section('page-title', $supplier->name)
@section('breadcrumb-parent')
    <a href="{{ route('suppliers.index') }}">Suppliers</a>
@endsection

@section('page-actions')
    <div x-data class="d-flex gap-2 flex-wrap">
        <button type="button" class="btn btn-sm btn-success" x-on:click="Livewire.dispatch('supplier-payment-create', { supplierId: {{ $supplier->id }} })"><i class="ri-money-dollar-circle-line me-1"></i>Pay Supplier</button>
        <button type="button" class="btn btn-sm btn-light" x-on:click="Livewire.dispatch('payment-create', { method: 'goods' })"><i class="ri-shopping-cart-2-line me-1"></i>Goods Purchase</button>
    </div>
@endsection

@section('content')
    @php($owedRows = \App\Services\Balances::suppliers(supplierId: $supplier->id))
    @php($companyNames = \App\Models\Company::withTrashed()->pluck('name', 'id'))
    <div class="row g-3 mb-3">
        @forelse ($owedRows as $row)
            <div class="col-sm-6 col-xl-3">
                <x-stat-card :label="'Owed by '.($companyNames[$row->company_id] ?? '?')" :value="money($row->owed)" icon="ri-building-2-line" color="warning" :hint="'Bought '.money($row->purchased).' · paid '.money($row->paid)" />
            </div>
        @empty
            <div class="col-12"><div class="alert alert-light border mb-0">No purchases from {{ $supplier->name }} yet.</div></div>
        @endforelse
    </div>

    <ul class="nav nav-tabs mb-3 flex-nowrap overflow-x-auto overflow-y-hidden text-nowrap" role="tablist">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-ledger" type="button">Ledger</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-purchases" type="button">Purchases</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-paid" type="button">Payments made</button></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="tab-ledger"><livewire:statements.ledger kind="supplier" :subject-id="$supplier->id" /></div>
        <div class="tab-pane fade" id="tab-purchases"><livewire:payments.list :supplier-id="$supplier->id" /></div>
        <div class="tab-pane fade" id="tab-paid"><livewire:supplier-payments.manage :supplier-id="$supplier->id" /></div>
    </div>

    <livewire:payments.create />
@endsection
