@extends('layouts.app')

@section('title', $account->shortLabel())
@section('page-title', $account->shortLabel())
@section('breadcrumb-parent')
    @if ($account->company_id)
        <a href="{{ route('companies.show', $account->company_id) }}">{{ $account->company->name }}</a>
    @else
        <a href="{{ route('accounts.index') }}">{{ $account->agent_id ? $account->holderName() : 'Cash & Bank' }}</a>
    @endif
@endsection

@section('page-actions')
    <div x-data class="d-flex gap-2 flex-wrap align-items-center">
        <span class="badge bg-light text-body fs-13 px-3 py-2">Balance <strong class="ms-1">{{ money($account->current_balance) }}</strong></span>
        @unless ($account->isAdminCash())
            <button type="button" class="btn btn-sm btn-light" x-on:click="Livewire.dispatch('account-edit', { id: {{ $account->id }} })"><i class="ri-edit-line me-1"></i>Edit account</button>
        @endunless
    </div>
@endsection

@section('content')
    @if ($account->isAdminCash())
        <div class="alert alert-light border fs-13">
            <i class="ri-wallet-3-line text-success me-1"></i>The admin's cash in hand, shared by every company. Filter the statement by company to see one company's cash.
        </div>
    @elseif (! $account->isCash())
        <div class="card"><div class="card-body d-flex flex-wrap gap-4 fs-13">
            <span><span class="text-muted">Bank</span> <strong>{{ $account->bank_name }}</strong></span>
            @if ($account->branch)<span><span class="text-muted">Branch</span> <strong>{{ $account->branch }}</strong></span>@endif
            @if ($account->account_title)<span><span class="text-muted">Title</span> <strong>{{ $account->account_title }}</strong></span>@endif
            @if ($account->account_number)<span><span class="text-muted">A/c</span> <strong>{{ $account->account_number }}</strong></span>@endif
            @if ($account->iban)<span><span class="text-muted">IBAN</span> <strong>{{ $account->iban }}</strong></span>@endif
        </div></div>
    @endif

    <livewire:statements.ledger kind="account" :subject-id="$account->id" />
    <livewire:accounts.manage :modal-only="true" />
@endsection
