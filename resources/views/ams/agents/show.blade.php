@extends('layouts.app')

@php($mine = auth()->id() === $agent->id)

@section('title', $mine ? 'My Ledger' : $agent->name)
@section('page-title', $mine ? 'My Ledger' : $agent->name)
@section('breadcrumb-parent')
    @if ($mine)
        My Money
    @else
        <a href="{{ route('agents.index') }}">Agents</a>
    @endif
@endsection

@section('page-actions')
    <div x-data class="d-flex gap-2 flex-wrap">
        @if ($mine)
            <button type="button" class="btn btn-sm btn-success" x-on:click="Livewire.dispatch('agent-return-create')"><i class="ri-user-received-line me-1"></i>Return money</button>
        @else
            <button type="button" class="btn btn-sm btn-success" x-on:click="Livewire.dispatch('transfer-create', { mode: 'advance', agentId: {{ $agent->id }} })"><i class="ri-user-shared-line me-1"></i>Send advance</button>
            <button type="button" class="btn btn-sm btn-light" x-on:click="Livewire.dispatch('transfer-create', { mode: 'return', agentId: {{ $agent->id }} })"><i class="ri-user-received-line me-1"></i>Record return</button>
            <a href="{{ route('accounts.index') }}#agent-{{ $agent->id }}" class="btn btn-sm btn-light"><i class="ri-bank-line me-1"></i>Accounts</a>
        @endif
    </div>
@endsection

@section('content')
    @unless ($agent->is_active)
        <div class="alert alert-secondary">This agent is inactive and can't sign in.</div>
    @endunless

    <livewire:agents.summary :agent-id="$agent->id" />
    <livewire:statements.ledger kind="agent" :subject-id="$agent->id" />
    <livewire:agents.returns :agent-id="$agent->id" />

    @unless ($mine)
        <livewire:transfers.manage :modal-only="true" />
    @endunless
@endsection
