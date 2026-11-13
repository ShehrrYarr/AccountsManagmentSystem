@extends('layouts.app')

@php($isAdmin = auth()->user()->isAdmin())

@section('title', $isAdmin ? 'Department Payments' : 'My Department Payments')
@section('page-title', $isAdmin ? 'Department Payments' : 'My Department Payments')
@section('breadcrumb-parent', 'Money Out')

@section('page-actions')
    <div x-data class="d-flex gap-2 flex-wrap">
        <a href="{{ route('payments.create') }}" class="btn btn-sm btn-primary"><i class="ri-add-circle-line me-1"></i>Pay Department</a>
        @if ($isAdmin)
            <button type="button" class="btn btn-sm btn-success" x-on:click="Livewire.dispatch('payment-create', { method: 'cash' })"><i class="ri-hand-coin-line me-1"></i>Give Cash</button>
            <button type="button" class="btn btn-sm btn-light" x-on:click="Livewire.dispatch('payment-create', { method: 'bank_transfer' })"><i class="ri-bank-line me-1"></i>Bank Transfer</button>
            <button type="button" class="btn btn-sm btn-warning" x-on:click="Livewire.dispatch('payment-create', { method: 'goods' })"><i class="ri-shopping-cart-2-line me-1"></i>Goods Purchase</button>
        @endif
    </div>
@endsection

@section('content')
    <livewire:payments.list />

    <livewire:payments.create />
@endsection
