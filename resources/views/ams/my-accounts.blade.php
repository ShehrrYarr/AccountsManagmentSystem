@extends('layouts.app')

@section('title', 'My Accounts')
@section('page-title', 'My Accounts')
@section('breadcrumb-parent', 'My Money')

@can('admin')
@else
    @section('page-actions')
        <div x-data class="d-flex gap-2 flex-wrap">
            <button type="button" class="btn btn-sm btn-success" x-on:click="Livewire.dispatch('agent-return-create')"><i class="ri-user-received-line me-1"></i>Return money</button>
            <a href="{{ route('my-ledger') }}" class="btn btn-sm btn-light"><i class="ri-book-open-line me-1"></i>My ledger</a>
        </div>
    @endsection
@endcan

@section('content')
    @can('admin')
        <div class="alert alert-info">This page is for agents. Agents' accounts are on <a href="{{ route('accounts.index') }}">Cash &amp; Bank</a> and <a href="{{ route('agents.index') }}">Agents</a>.</div>
    @else
        <livewire:accounts.manage :mine="true" />
        <livewire:agents.returns :agent-id="auth()->id()" />
    @endcan
@endsection
