@extends('layouts.app')

@php($isAdmin = auth()->user()->isAdmin())

@section('title', $account->shortLabel())
@section('page-title', $account->shortLabel())
@section('breadcrumb-parent')
    @if (! $isAdmin)
        <a href="{{ route('my-accounts') }}">My Accounts</a>
    @elseif ($account->company_id)
        <a href="{{ route('companies.show', $account->company_id) }}">{{ $account->company->name }}</a>
    @elseif ($account->agent_id)
        <a href="{{ route('agents.show', $account->agent_id) }}">{{ $account->holderName() }}</a>
    @else
        <a href="{{ route('accounts.index') }}">Cash &amp; Bank</a>
    @endif
@endsection

@section('page-actions')
    <div x-data class="d-flex gap-2 flex-wrap align-items-center">
        <span class="badge bg-light text-body fs-13 px-3 py-2">Balance <strong class="ms-1">{{ money($account->current_balance) }}</strong></span>
        @if ($isAdmin && ! $account->isAdminCash())
            @if ($account->agent_id)
                <button type="button" class="btn btn-sm btn-success" x-on:click="Livewire.dispatch('transfer-create', { mode: 'advance', agentId: {{ $account->agent_id }} })"><i class="ri-user-shared-line me-1"></i>Send advance</button>
            @endif
            <button type="button" class="btn btn-sm btn-light" x-on:click="Livewire.dispatch('account-edit', { id: {{ $account->id }} })"><i class="ri-edit-line me-1"></i>Edit account</button>
        @endif
    </div>
@endsection

@section('content')
    @if ($account->isAdminCash())
        <div class="alert alert-light border fs-13">
            <i class="ri-wallet-3-line text-success me-1"></i>The admin's cash in hand: one pot that belongs to no company.
        </div>
    @elseif ($account->agent_id)
        <div class="alert alert-light border fs-13">
            <i class="ri-user-star-line text-primary me-1"></i>{{ $isAdmin ? $account->holderName().'’s' : 'Your' }} {{ $account->isCash() ? 'cash in hand' : 'bank account' }}.
            Its balance is company money held for the companies, owed back to them. Filter the statement by company to see one company's share.
            @if (! $account->isCash() && $account->bank_name)
                <div class="mt-1">{{ $account->bank_name }}@if ($account->account_number) · A/c {{ $account->account_number }}@endif @if ($account->branch) · {{ $account->branch }}@endif</div>
            @endif
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
    @if ($isAdmin)
        <livewire:accounts.manage :modal-only="true" />
        @if ($account->agent_id)
            <livewire:transfers.manage :modal-only="true" />
        @endif
    @endif
@endsection
