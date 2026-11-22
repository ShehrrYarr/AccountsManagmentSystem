@extends('layouts.app')

@section('title', 'Pay Supplier')
@section('page-title', 'Pay Supplier')
@section('breadcrumb-parent')<a href="{{ route('supplier-payments.index') }}">Supplier Payments</a>@endsection

@section('page-actions')
    <a href="{{ route('supplier-payments.index') }}" class="btn btn-sm btn-light">
        <i class="ri-arrow-left-line me-1"></i>All supplier payments
    </a>
@endsection

@section('content')
    @include('layouts.partials.form-draft')
    <livewire:supplier-payments.create :as-page="true" :company="request()->query('company')" :supplier="request()->query('supplier')" />
@endsection
