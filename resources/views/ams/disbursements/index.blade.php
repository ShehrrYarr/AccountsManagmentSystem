@extends('layouts.app')

@section('title', 'Disbursements')
@section('page-title', 'Disbursements')
@section('breadcrumb-parent', 'Cash Out')

@section('page-actions')
    <div class="btn-group" x-data>
        <button type="button" class="btn btn-sm btn-primary" x-on:click="Livewire.dispatch('disbursement-create', { type: 'cash_payout' })">
            <i class="ri-hand-coin-line me-1"></i>Cash Payout
        </button>
        <button type="button" class="btn btn-sm btn-primary" x-on:click="Livewire.dispatch('disbursement-create', { type: 'bank_transfer' })">
            <i class="ri-exchange-funds-line me-1"></i>Bank Transfer
        </button>
        <button type="button" class="btn btn-sm btn-primary" x-on:click="Livewire.dispatch('disbursement-create', { type: 'vendor_purchase' })">
            <i class="ri-shopping-bag-3-line me-1"></i>Purchase
        </button>
    </div>
@endsection

@section('content')
    <livewire:disbursements.list />
    <livewire:disbursements.create />
@endsection
