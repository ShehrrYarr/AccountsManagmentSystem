@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('page-actions')
    <div x-data class="d-flex gap-2 flex-wrap">
        <button type="button" class="btn btn-sm btn-primary" x-on:click="Livewire.dispatch('cheque-create')">
            <i class="ri-bank-card-line me-1"></i>Receive Cheque
        </button>
        <button type="button" class="btn btn-sm btn-success" x-on:click="Livewire.dispatch('disbursement-create')">
            <i class="ri-hand-coin-line me-1"></i>Pay Company
        </button>
    </div>
@endsection

@section('content')
    <livewire:dashboard.overview-metrics />

    <div class="mb-4">
        <livewire:dashboard.charts />
    </div>

    <div class="row g-3">
        <div class="col-xl-7">
            <livewire:transactions.datatable :compact="true" />
        </div>
        <div class="col-xl-5">
            <livewire:dashboard.attention />
        </div>
    </div>

    {{-- Modals available from the dashboard quick actions --}}
    <livewire:cheques.register-cheque />
    <livewire:cheques.clear-cheque />
    <livewire:disbursements.create />
@endsection
