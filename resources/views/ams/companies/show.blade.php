@extends('layouts.app')

@section('title', $company->name)
@section('page-title', $company->name)
@section('breadcrumb-parent')
    <a href="{{ route('companies.index') }}">Companies</a>
@endsection

@section('page-actions')
    <div x-data class="d-flex gap-2 flex-wrap">
        <button type="button" class="btn btn-sm btn-primary" x-on:click="Livewire.dispatch('cheque-create', { companyId: {{ $company->id }} })"><i class="ri-bank-card-line me-1"></i>Receive Cheque</button>
        <button type="button" class="btn btn-sm btn-success" x-on:click="Livewire.dispatch('payment-create', { companyId: {{ $company->id }} })"><i class="ri-hand-coin-line me-1"></i>Pay Department</button>
        <button type="button" class="btn btn-sm btn-light" x-on:click="Livewire.dispatch('transfer-create', { companyId: {{ $company->id }} })"><i class="ri-arrow-left-right-line me-1"></i>Transfer</button>
        <button type="button" class="btn btn-sm btn-light" x-on:click="Livewire.dispatch('expense-create', { companyId: {{ $company->id }} })"><i class="ri-receipt-line me-1"></i>Expense</button>
    </div>
@endsection

@section('content')
    <livewire:companies.summary :company-id="$company->id" />

    <ul class="nav nav-tabs mb-3 flex-nowrap overflow-x-auto overflow-y-hidden text-nowrap" role="tablist">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-ledger" type="button">Company ledger</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-depts" type="button">Departments</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-cheques" type="button">Cheques</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-payments" type="button">Payments</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-transfers" type="button">Transfers</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-expenses" type="button">Expenses</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-journal" type="button">Journal</button></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="tab-ledger"><livewire:statements.ledger kind="company" :subject-id="$company->id" /></div>
        <div class="tab-pane fade" id="tab-depts">
            <livewire:departments.balances :company-id="$company->id" />
            <livewire:departments.closings :company-id="$company->id" />
        </div>
        <div class="tab-pane fade" id="tab-cheques"><livewire:cheques.list :company-id="$company->id" /></div>
        <div class="tab-pane fade" id="tab-payments"><livewire:payments.list :company-id="$company->id" /></div>
        <div class="tab-pane fade" id="tab-transfers"><livewire:transfers.manage :company-id="$company->id" /></div>
        <div class="tab-pane fade" id="tab-expenses"><livewire:expenses.manage :company-id="$company->id" /></div>
        <div class="tab-pane fade" id="tab-journal"><livewire:transactions.datatable :company-id="$company->id" /></div>
    </div>

    <livewire:cheques.register-cheque />
    <livewire:cheques.deposit-cheque />
    <livewire:payments.create />
    <livewire:departments.close-deal />
    <livewire:accounts.manage :modal-only="true" />
@endsection
