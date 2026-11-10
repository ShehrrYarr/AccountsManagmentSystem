@extends('layouts.app')

@section('title', 'Department Payments')
@section('page-title', 'Department Payments')
@section('breadcrumb-parent', 'Money Out')

@section('page-actions')
    <div x-data class="d-flex gap-2 flex-wrap">
        <button type="button" class="btn btn-sm btn-success" x-on:click="Livewire.dispatch('payment-create', { method: 'cash' })"><i class="ri-hand-coin-line me-1"></i>Give Cash</button>
        <button type="button" class="btn btn-sm btn-primary" x-on:click="Livewire.dispatch('payment-create', { method: 'bank_transfer' })"><i class="ri-bank-line me-1"></i>Bank Transfer</button>
        <button type="button" class="btn btn-sm btn-warning" x-on:click="Livewire.dispatch('payment-create', { method: 'goods' })"><i class="ri-shopping-cart-2-line me-1"></i>Goods Purchase</button>
    </div>
@endsection

@section('content')
    <livewire:payments.list />

    <livewire:payments.create />
@endsection
