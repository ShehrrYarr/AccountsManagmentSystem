@extends('layouts.app')

@section('title', $company->name)
@section('page-title', $company->name)
@section('breadcrumb-parent')
    <a href="{{ route('companies.index') }}">Companies</a>
@endsection

@section('page-actions')
    <div x-data class="d-flex gap-2 flex-wrap">
        <button type="button" class="btn btn-sm btn-primary" x-on:click="Livewire.dispatch('cheque-create', { companyId: {{ $company->id }} })">
            <i class="ri-bank-card-line me-1"></i>Receive Cheque
        </button>
        <button type="button" class="btn btn-sm btn-success" x-on:click="Livewire.dispatch('disbursement-create', { companyId: {{ $company->id }} })">
            <i class="ri-hand-coin-line me-1"></i>Pay Out
        </button>
        <button type="button" class="btn btn-sm btn-light" x-on:click="Livewire.dispatch('company-accounts', { companyId: {{ $company->id }} })">
            <i class="ri-bank-line me-1"></i>Bank Accounts
        </button>
    </div>
@endsection

@section('content')
    <livewire:companies.summary :company-id="$company->id" />

    <ul class="nav nav-tabs mb-3 flex-nowrap overflow-x-auto overflow-y-hidden text-nowrap" role="tablist">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-statement" type="button">Statement</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-cheques" type="button">Cheques</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-payouts" type="button">Disbursements</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-journal" type="button">Journal</button></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="tab-statement"><livewire:companies.statement :company-id="$company->id" /></div>
        <div class="tab-pane fade" id="tab-cheques"><livewire:cheques.list :company-id="$company->id" :status="'all'" /></div>
        <div class="tab-pane fade" id="tab-payouts"><livewire:disbursements.list :company-id="$company->id" /></div>
        <div class="tab-pane fade" id="tab-journal"><livewire:transactions.datatable :company-id="$company->id" /></div>
    </div>

    <livewire:cheques.register-cheque />
    <livewire:cheques.clear-cheque />
    <livewire:cheques.close-cheque />
    <livewire:disbursements.create />
    <livewire:companies.bank-accounts />
@endsection
